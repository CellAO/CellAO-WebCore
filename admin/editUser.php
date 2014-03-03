<?php
	isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : $userId = "";
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	require_once('../includes/header.php');
	if($userId == ""){
		header("Location: findUser.php");
		exit;
	}
?>


<?php
	require_once('../includes/footer.php');
?>
