<?php 
	//Include database connection details
	require_once('includes/config.php');
	require_once('engine.php');
	//Array to store validation errors
	$errmsgs = array();
	//Highlighted fields
	$errorFields = array();
	//Registration Details
	$regArgs = array();

	$errorText = "";
	if(isset($_POST['Submit']) && $_POST['Submit'] == "Register"){
		//Our database connection.
		global $pdo;


		//Sanitize the POST values
		$regArgs[':firstName'] = (isset($_POST['firstName']) && $_POST['firstName'] != "First Name") ? $_POST['firstName'] : "";
		$regArgs[':lastName'] = (isset($_POST['lastName']) && $_POST['lastName'] != "Last Name") ? $_POST['lastName'] : "";
		$regArgs[':email'] = (isset($_POST['email']) && $_POST['email'] != "Email Address") ? $_POST['email'] : "";
		$regArgs[':login'] = (isset($_POST['login']) && $_POST['login'] != "Username") ? $_POST['login'] : "";
		$regArgs[':password'] = (isset($_POST['password']) && $_POST['password'] != "Password") ? $_POST['password'] : "";
		$regArgs[':cPassword'] = (isset($_POST['cPassword']) && $_POST['cPassword'] != "Password Again") ? $_POST['cPassword'] : "";
		//Default registration values
		$regArgs[':creationDate'] = date('Y-m-d H:i:s');
		$regArgs[':allowedCharacters'] = "6";
		$regArgs[':flags'] = "0";
		$regArgs[':accountFlags'] = "0";
		$regArgs[':expansions'] = "2047";
		$regArgs[':gm'] = "0";

		foreach($regArgs as $index => $value){
			$regArgs[$index] = trim($value);
			$value = trim($value);
			if($value == ""){
				$errmsgs["Missing or blank fields."] = true;
				$errorFields[substr($index, 1)] = true;
			}

			//Make sure all fields, except passwords, don't have funky characters
			if($index != ":password" && $index != ":cPassword" && $index != ":creationDate"){
				if($index == ":email"){
					if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
						$errmsgs["Invalid email detected."] = true;
						$errorFields[':email'] = true;
					}
				} else if(!ctype_alnum($value)){
					$errmsgs["Invalid characters detected."] = true;
					$errorFields[substr($index, 1)] = true;
				}
			}
		}

		if($regArgs[':password'] != $regArgs[':cPassword']){
			$errmsgs["Passwords to not match."] = true;
			$errorFields['password'] = true;
			$errorFields['cPassword'] = true;
		}
		if(strlen($regArgs[':password']) < 8){
			$errmsgs["Passwords must be longer than eight characters."] = true;
			$errorFields['password'] = true;
			$errorFields['cPassword'] = true;
		}
		
		unset($regArgs[':cPassword']);

		if($regArgs[':login'] != '') {
			//Check for duplicate login information
			$sth = $pdo->prepare("SELECT SUM(`login`.`Email` = :email) as 'Email', 
								SUM(`login`.`Username` = :login) as 'Username'
								FROM `login`
								WHERE `login`.`Email`=:email 
								OR `login`.`Username`=:login");
			$sth->execute(array(':email' => $regArgs[':email'], ':login' => $regArgs[':login']));
			$results = $sth->fetch(PDO::FETCH_ASSOC);
			if($results['Email'] > 0){
				$errmsgs['There is already an account associated with this e-mail.'] = true;
				$errorFields['email'] = true;
			}
			if($results['Username'] > 0){
				$errmsgs['Username has already been taken.'] = true;
				$errorFields['username'] = true;
			} 
		} else {
			$errmsgs['Username is missing.'] = true;
			$errorFields['login'] = true;
		}

		if (!$regArgs[':password'] = create_hash($regArgs[':password'])){
			$errmsgs['Error creating account password.'] = true;
		}

		if(sizeof($errmsgs) > 0){
			$errorText = "Errors: <br />";
			foreach ($errmsgs as $error => $value) {
				$errorText .= $error . "<br />";
			}
			$_REQUEST['err'] = $errorText;
		} else {
			$sth = $pdo->prepare("INSERT INTO `login` (`login`.`CreationDate`,
										`login`.`Email`,
										`login`.`Username`,
										`login`.`Password`,
										`login`.`AllowedCharacters`,
										`login`.`Flags`,
										`login`.`Accountflags`,
										`login`.`Expansions`,
										`login`.`GM`,
										`login`.`FirstName`,
										`login`.`LastName`)
								VALUES (:creationDate, 
										:email,
										:login,
										:password,
										:allowedCharacters,
										:flags,
										:accountFlags,
										:expansions, 
										:gm, 
										:firstName,
										:lastName)");
			if($sth->execute($regArgs)){
				header("Location: index.php?msg=User account successfully created.<br />Please login to continue.");
			} else {
				$errmsgs['There was a problem creating your account.<br />Please contact an administrator for further assistance.'] = true;
			}
		}
	}

	$includeCSSFiles[] = 'css/registration.css';
	require_once('includes/header.php');

?>
<div style="text-align: center; : 10px;">
	<form id="loginForm" name="loginForm" method="post" action="register.php" style="clear: both;">
		<div class="<?php echo (array_key_exists('firstName', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 20px;"><input value="<?php echo (isset($regArgs[':firstName']) && sizeof($regArgs[':firstName']) > 1) ? $regArgs[':firstName'] : "First Name"; ?>" name="firstName" id="firstName" type="text" class="registerForm textfield" alt="First Name"/></div>
		<div class="<?php echo (array_key_exists('lastName', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 2px;"><input value="<?php echo (isset($regArgs[':lastName']) && sizeof($regArgs[':lastName']) > 1) ? $regArgs[':lastName'] : "Last Name"; ?>" name="lastName" id="lastName" type="text" class="registerForm textfield" alt="Last Name"/></div>
		<div class="<?php echo (array_key_exists('email', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 2px;"><input value="<?php echo (isset($regArgs[':email']) && sizeof($regArgs[':email']) > 1) ? $regArgs[':email'] : "Email Address"; ?>" name="email" id="email" type="text" class="registerForm textfield" alt="Email Address"/></div>
		<div class="<?php echo (array_key_exists('login', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 2px;"><input value="<?php echo (isset($regArgs[':login']) && sizeof($regArgs[':login']) > 1) ? $regArgs[':login'] : "Username"; ?>" name="login" id="login" type="text" class="registerForm textfield" alt="Username"/></div>
		<div class="<?php echo (array_key_exists('password', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 2px;"><input value="Password" name="password" id="password" type="text" class="registerForm textfield" alt="Password"/></div>
		<div class="<?php echo (array_key_exists('cPassword', $errorFields)) ? "highlited" : "not-highlighted"; ?>" style="margin-top: 2px;"><input value="Password Again" name="cPassword" id="cPassword" type="text" class="registerForm textfield" alt="Password Again"/></div>
		<input type="submit" class="registerForm" style="margin-top: 5px;" name="Submit" value="Register" />
		<input type="button" id="cancelButton" class="registerForm" style="margin-top: 5px;" name="Submit" value="Cancel" />
	</form>
</div>
<script>
	$('.registerForm').on('focusin focusout', function(event){
		if($(this).attr('name') == 'password' || $(this).attr('name') == 'cPassword'){
			if($(this).val() != $(this).attr('alt')){
				if($(this).val() == ''){
					$(this).attr('type', 'text');
					$(this).val($(this).attr('alt'));
				}
			} else {
				$(this).attr('type', 'password');
				$(this).val('');
			}
		} else if($(this).attr('type') == "text"){
			if($(this).val() != $(this).attr('alt')){
				if($(this).val() == '')
					$(this).val($(this).attr('alt'));
			} else {
				$(this).val('');
			}
		}
	});

	$('#cancelButton').on('click', function(event){
		window.location = 'index.php';
	});
</script>
<?php require_once('includes/footer.php'); ?>