<?php
	require_once('configs/config.php');
	// var_dump($_SESSION); 
	// exit;
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		header("location: /access-denied.php");
		exit();
	}
?>