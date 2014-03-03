<?php
	require_once('includes/config.php');		
	//Unset the variables stored in session
    unset($_SESSION['SESS_ID']);
    unset($_SESSION['SESS_CREATIONDATE']);
    unset($_SESSION['SESS_EMAIL']); 
    unset($_SESSION['SESS_USER_NAME']);
    unset($_SESSION['SESS_ALLOWED_CHARACTERS']);
    unset($_SESSION['SESS_FLAGS']);
    unset($_SESSION['SESS_ACCOUNTFLAGS']);
    unset($_SESSION['SESS_EXPANSIONS']);
    unset($_SESSION['SESS_GM']); 
    unset($_SESSION['SESS_FIRST_NAME']);
    unset($_SESSION['SESS_LAST_NAME']);
    header('Location: index.php?msg=You have been logged out.'); 
    exit;
?>
