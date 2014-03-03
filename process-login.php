<?php
	//TODO: Turn this into a web service that allows you to login without navigating away from page.
	//TODO: Change MySQL to PDO based queries.
	//Include database connection details
	require_once('includes/config.php');
	require_once('engine.php');
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		loginFailed(array("Unable to connect to system database at this time.", "Please try again later."));
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		loginFailed(array("Unable to connect to system database at this time.", "Please try again later."));
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	isset($_POST['login']) ? $login = clean($_POST['login']) : $login = '';
	isset($_POST['password']) ? $password = clean($_POST['password']) : $password = '';
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
	}
	
	//If there are input validations, redirect back to the login form
	if(sizeof($errmsg_arr) > 0){
		loginFailed($errmsg_arr);
	}
	
	//Create query
	$qry="SELECT * FROM login WHERE Username='$login'";
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			// var_dump($member); exit;
			$passhash = $member['Password'];
			if (!webpass($passhash,$password))
			{
				loginFailed(array('Failed to log you in.'));
			}
			//CreationDate, Email, Username, Password, Allowed_Characters, Flags, Accountflags, Expansions, GM, FirstName, LastName
			$_SESSION['SESS_ID'] = $member['Id'];
			$_SESSION['SESS_CREATIONDATE'] = $member['CreationDate'];
			$_SESSION['SESS_EMAIL'] = $member['Email'];
			$_SESSION['SESS_USER_NAME'] = $member['Username'];
			$_SESSION['SESS_ALLOWED_CHARACTERS'] = $member['Allowed_Characters'];
			$_SESSION['SESS_FLAGS'] = $member['Flags'];
			$_SESSION['SESS_ACCOUNTFLAGS'] = $member['AccountFlags'];
			$_SESSION['SESS_EXPANSIONS'] = $member['Expansions'];
			$_SESSION['SESS_GM'] = $member['GM'];
			$_SESSION['SESS_FIRST_NAME'] = $member['FirstName'];
			$_SESSION['SESS_LAST_NAME'] = $member['LastName'];
			session_write_close();
			header("location: member-index.php");
			exit();
		}else {
		}
	}else {
		loginFailed(array('Unable to log you in at this time.', 'Please try again later.'));
	}

	function loginFailed($errorMessages){
		foreach ($errorMessages as $error) {
			$errorText .= $error . "<br />";
		}
		header("location: register.php?err=" . $errorText);
		exit();
	}
?>