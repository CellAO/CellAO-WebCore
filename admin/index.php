<?php
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	require_once('../includes/header.php');
	//FIXME: Need to pull out header and footer and replace them with header.php and footer.php
	//TODO: Want to create a web service that allows you to pull user details.
	//TODO: List all users and allow admins to select them. 
	//TODO: Ability to spawn inventory items
	//TODO: Ability to change user PF
	//TODO: Test for functionality
?>
	<div style="display: inline-block">
		<ul>
			<li>
				<a href="editUser.php">Edit a user</a>
			</li>
			<li>
				<a href="#">Placeholder</a>
			</li>
			<li>
				<a href="#">Placeholder</a>
			</li>
			<li>
				<a href="#">Placeholder</a>
			</li>
		</ul>
	</div>



<?php
	require_once('../includes/footer.php');
?>
