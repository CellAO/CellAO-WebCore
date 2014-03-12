<?php

// BitFields
//
// Expansions
// 0 = "Notum Wars"
// 1 = "Shadow Lands"
// 2 = "Shadow Lands Pre-Order"
// 3 = "Alien Invasion"
// 4 = "Alien Invasion Pre-Order"
// 5 = "Lost Eden"
// 6 = "Lost Eden Pre-Order"
// 7 = "Legacy of Xan"
// 8 = "Legacy of Xan Pre-Order"
// 9 = "Mail"
//10 = "PMV Obsidian Edition"
// 0=1, 1=2, 2=4, 3=8, 4=16, 5=32, 6=64, 7=128, 8=256, 9=512, 10 = 1024
// So if you want to give someone all expansions is 1+2+4+8+16+32+64+128+256+512+1024 = 2047
//
// GM Levels
// 1-100
// 100=blackmanes statbuffer usable



	//Start session
	session_start();
	
	//Include database connection details
	require_once('includes/config.php');
	require_once('engine.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
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
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$email = clean($_POST['email']);
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
	//TODO: Additional input validations. Password length, actual e-mail, login length, etc.
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
	}
	if($email == '') {
		$errmsg_arr[] = 'Email Address missing';
	}
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
	}
	
	//Check for duplicate login information
	if($login != '') {
		$qry = "SELECT * FROM login WHERE Username='$login'";
		$result = mysql_query($qry);
		$member = mysql_fetch_assoc($result);
		if($member['Email']==$email) {
			$errmsg_arr[] = 'The Email <b>'.$email.'</b> already exists.<br>Please register with another email.<br>Only one account can be registered oin this server.<br>We have logged this attempt with your IP.<br>You have been warned.';

			@mysql_free_result($result);
		}elseif ($member['Username']==$login) {
			$errmsg_arr[] = 'The User <b>'.$login.'</b> already exists.<br>Please choose another name.';

			@mysql_free_result($result);
		}
	}

	if(sizeof($errmsg_arr) > 0) {
		registerFailed($errmsg_arr);
	}
		
	//Extra Detail to fill in the User fields
	$creationdate = date('Y-m-d H:i:s');
	$allowed_characters = "6";
	$flags = "0";
	$accountflags = "0";
	$expansions = "2047";
	$gm = "0";
	
	//Create INSERT query
	if (!$acntpwd = createhash($password)){
		registerFailed(array('Error creating account password.'));
		exit();
	}else {
		//FIXME: Query does not work right now. 
		//TODO: Switch to MySQL PDO
		$qry = "INSERT INTO login(CreationDate, Email, Username, Password, AllowedCharacters, Flags, Accountflags, Expansions, GM, FirstName, LastName) VALUES('$creationdate', '$email', '$login', '$acntpwd', '$allowed_characters', '$flags', '$accountflags', '$expansions', '$gm', '$fname', '$lname')";
		$result = @mysql_query($qry);
			if($result) {
			header("location: index.php?msg=Account successfully created. Please log in to continue.");
			exit();
		}else {
			registerFailed(array('Error creating user account.'));
		}
	}

	function registerFailed($errorMessages){
		foreach ($errorMessages as $error) {
			$errorText .= $error . "<br />";
		}
		header("location: register.php?err=" . $errorText);
		exit();
	}
?>