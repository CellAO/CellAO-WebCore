<?php
// Define DB Internals for SimpleSQL CellAO WebCore
	define('DB_HOST', 'localhost');
	define('DB_USER', 'cellaodbuser');
	define('DB_PASSWORD', 'password');
	define('DB_DATABASE', 'cellao');
// Define other variables
	session_start();




	/*==============
	*
	* Do not edit below this line unless
	* you know what you're doing!
	*
	================*/
	$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD, array());
	defined('PRE_LINK') ? $preLink = PRE_LINK : $preLink = "";

	//Pretty sure there's a better way to do this, but I'm lazy right now. 
	//TODO: Rework this later.
	if(isset($includeCSSFiles)){
		$includeCSSFiles[] = $preLink . 'css/style.css';
	} else {
		$includeCSSFiles = array($preLink . 'css/style.css');
	}
	if(isset($includeJavascriptFiles)){
	} else {
		$includeJavascriptFiles = array();
	}

	//TODO: Not entirely sure how secure using sessions is to handle this stuff. Need to research it more.
	if(defined('AUTH_REQUIRED')){
		if(AUTH_REQUIRED){
		//User must be logged in
			if(!isset($_SESSION['SESS_ID'])){
				header("Location: " . $preLink . "index.php?err=You must be logged in to view this page.");
			}
		}
	}
	if(defined('ADMIN_REQUIRED')){
		if(ADMIN_REQUIRED){
			//GM Level == 100 required
			if($_SESSION['SESS_GM'] < 100){
				header("Location: " . $preLink . "index.php?err=You do not have sufficient permission to view this page.");
			}
		}
	}
	if(defined('GM_REQUIRED')){
		if(GM_REQUIRED){
			//GM Level > 0 required
			if($_SESSION['SESS_GM'] < 1){
				header("Location: " . $preLink . "index.php?err=You do not have sufficient permission to view this page.");
			}
		}
	}


?>