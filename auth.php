<?php
	require_once('includes/config.php');
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
		header("Location: index.php?err=You do not have permission to view this page.<br />Please verify that you're logged in and try again.");
		exit();
	}
?>