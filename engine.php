<?PHP

define("PBKDF2_HASH_ALGORITHM", "sha1");
define("PBKDF2_ITERATIONS", 1111);
define("PBKDF2_SALT_BYTES", 30);
define("PBKDF2_HASH_BYTES", 30);

define("HASH_SECTIONS", 3);
define("HASH_ITERATION_INDEX", 0);
define("HASH_SALT_INDEX", 1);
define("HASH_PBKDF2_INDEX", 2);


function CreateAccount($username, $password, $charsallowed, $expansion, $email)
{
	$passhash = create_hash($password);
	$connection=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connection failed");	
	mysql_select_db(DB_DATABASE,$connection);
	$query = mysql_query("INSERT INTO login (CreationDate, Email, Username, Password, Allowed_Characters, Flags, Accountflags, Expansions, GM) VALUES (NOW(), '$email', '$username', '$passhash', $charsallowed, 0,0, $expansion, 0)");
	if ($query===false)
	{
		return false;
	}
	return true;
}

function create_hash($password)
{
	// format: algorithm:iterations:salt:hash
	$salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));
	$addIter = rand(0,255) + PBKDF2_ITERATIONS;

	return $addIter . ":" . $salt . ":" .
		base64_encode(pbkdf2(
			"sha1",
			$password,
			base64_decode($salt),
			$addIter,
			PBKDF2_HASH_BYTES,
			true
		));
}

function validate_password($password, $good_hash)
{
	$params = explode(":", $good_hash);
	if(count($params) < HASH_SECTIONS)
	   return false;
	$pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
	return slow_equals(
		$pbkdf2,
		pbkdf2(
			"sha1",
			$password,
			base64_decode($params[HASH_SALT_INDEX]),
			(int)$params[HASH_ITERATION_INDEX],
			strlen($pbkdf2),
			true
		)
	);
}

// Compares two strings $a and $b in length-constant time.
function slow_equals($a, $b)
{
	$diff = strlen($a) ^ strlen($b);
	for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
	{
		$diff |= ord($a[$i]) ^ ord($b[$i]);
	}
	return $diff === 0;
}

function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
{
	$algorithm = strtolower($algorithm);
	if(!in_array($algorithm, hash_algos(), true))
		trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
	if($count <= 0 || $key_length <= 0)
		trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

	if (function_exists("hash_pbkdf2")) {
		// The output length is in NIBBLES (4-bits) if $raw_output is false!
		if (!$raw_output) {
			$key_length = $key_length * 2;
		}
		return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
	}

	$hash_length = strlen(hash($algorithm, "", true));
	$block_count = ceil($key_length / $hash_length);

	$output = "";
	for($i = 1; $i <= $block_count; $i++) {
		// $i encoded as 4 bytes, big endian.
		$last = $salt . pack("N", $i);
		// first iteration
		$last = $xorsum = hash_hmac($algorithm, $last, $password, true);
		// perform the other $count - 1 iterations
		for ($j = 1; $j < $count; $j++) {
			$xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
		}
		$output .= $xorsum;
	}

	if($raw_output)
		return substr($output, 0, $key_length);
	else
		return bin2hex(substr($output, 0, $key_length));
}

?>
