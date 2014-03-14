<?php
	define("GM_REQUIRED", True);
	require_once('../config.php');

	isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

	switch($action){
		case "getUserById":
			isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : printNoResults();
			echo(json_encode(getUser($userId)));
			break;
		case "getUserByUsername":
			isset($_REQUEST['username']) ? $username = $_REQUEST['username'] : printNoResults();
			echo(json_encode(getUser($username)));
			break;
		case "getAllUsers":
			echo(json_encode(getAllUsers()));
			break;
		case "getAllUsersTableJSON":
			echo(json_encode(getAllUsersTableJSON()));
			break;
		case "updateUserAttribute":
			isset($_REQUEST['query']) ? $query = $_REQUEST['query'] : printNoResults();
			echo(json_encode(udpateUserAttribute($query)));
			break;
		case "registerUser":

			break;

	}
	die();

	function getUser($query){
		global $pdo;
		$sql = "SELECT `login`.`Id`, `login`.`CreationDate`, `login`.`Email`, `login`.`FirstName`,
							`login`.`LastName`, `login`.`Username`, `login`.`Password`, `login`.`AllowedCharacters`, 
							`login`.`Flags`, `login`.`AccountFlags`, `login`.`Expansions`, `login`.`GM`
							FROM `login` WHERE `login`.";

		if(is_numeric($query)){
			$sth = $pdo->prepare("`Id` = :query");
		} else {
			$sth = $pdo->prepare("`Username` = :query");
		}
		$sth->execute(array(':query' => $query));
		$results = $sth->fetch(PDO::FETCH_ASSOC);
		return $results;	
	}

	function getAllUsers(){
		global $pdo;
		$sth = $pdo->prepare("SELECT `login`.`Id`, `login`.`CreationDate`, `login`.`Email`, `login`.`FirstName`,
							`login`.`LastName`, `login`.`Username`, `login`.`Password`, `login`.`AllowedCharacters`, 
							`login`.`Flags`, `login`.`AccountFlags`, `login`.`Expansions`, `login`.`GM`
							FROM `login`");
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	function getAllUsersTableJSON(){
		global $pdo;
		$sth = $pdo->prepare("SELECT `login`.`Id` as 'id', `login`.`CreationDate` as 'creationDate', `login`.`Email` as 'email', `login`.`FirstName` as 'firstName', `login`.`LastName` as 'lastName', `login`.`Username` as 'username', `login`.`Password` as 'password', `login`.`AllowedCharacters` as 'allowedCharacters', `login`.`Flags` as 'flags', `login`.`AccountFlags` as 'accountFlags', `login`.`Expansions` as 'expansions', `login`.`GM` as 'gm' FROM `login`");
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	function udpateUserAttribute($query){
		global $pdo; 
		$possibleKeys = array('Email', 'FirstName', 'LastName', 'Username', 'Password', 'AllowedCharacters', 'Flags', 'AccountFlags', 'Expansions', 'GM');
		$arguments = array();
		$sql = "UPDATE `login` SET ";
		foreach($_REQUEST as $key => $value){
			if(in_array($key, $possibleKeys)){
				$sql .= ' `login`.`' . $key . '` = :' . $key;
				$arguments[":".$key] = $value;
			}
		}
		$return = new stdClass; 
		if(sizeof($arguments) > 0){
			if(is_numeric($query)){
				$sql .= ' WHERE `login`.`Id` = :query';
			} else {
				$sql .= ' WHERE `login`.`Username` = :query';
			}
			$arguments[':query'] = $query;

			$sth = $pdo->prepare($sql);
			if($sth->execute($arguments)){
				$return->success = true; 
			} else {
				$return->success = false;
				$return->error = "Unable to execute SQL Query.";
			}
		} else {
			$return->success = false;
			$return->error = "No valid fields to update.";
		}
		return $return;
	}


	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>