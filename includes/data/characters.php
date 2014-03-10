<?php
	define("GM_REQUIRED", True);
	require_once('../config.php');

	isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

	switch($action){
		case "getCharacterList":
			isset($_REQUEST['query']) ? $query = $_REQUEST['query'] : printNoResults();
			echo(json_encode(getCharacterList($query)));
			break;
		case "getCharacterInfo":
			isset($_REQUEST['query']) ? $query = $_REQUEST['query'] : printNoResults();
			echo(json_encode(getCharacterInfo($query)));
			break;
		case "udpateCharacterAttribute":
			isset($_REQUEST['query']) ? $query = $_REQUEST['query'] : printNoResults();
			echo(json_encode(udpateCharacterAttribute($query)));
			break;
	}
	die();

	function getCharacterList($query){
		global $pdo;
		//Could probably build the sql more effectively here, but I'm lazy atm
		if(is_numeric($query)){
			$sth = $pdo->prepare("SELECT `characters`.`Id`, `characters`.`Name`
							FROM `characters`, `login` 
							WHERE `characters`.`Username` = `login`.`Username`
							AND `login`.`Id` = :userId");
			$arguments = array(':userId' => $query);
		} else {
			$sth = $pdo->prepare("SELECT `characters`.`Id`, `characters`.`Name`
									FROM `characters` 
									WHERE `characters`.`Username` = :username");
			$arguments = array(':username' => $query);
		}
		
		$sth->execute($arguments);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	
	function getCharacterInfo($query){
		global $pdo;
		$sql = "SELECT `characters`.`Id`, `characters`.`Username`, `characters`.`Name`, `characters`.`FirstName`, 
						`characters`.`LastName`, `characters`.`Textures0`, `characters`.`Textures1`, 
						`characters`.`Textures2`, `characters`.`Textures3`, `characters`.`Textures4`, 
						`characters`.`playfield`, `characters`.`X`, `characters`.`Y`, `characters`.`Z`, 
						`characters`.`HeadingX`, `characters`.`HeadingY`, `characters`.`HeadingZ`, 
						`characters`.`HeadingW`
				FROM `characters` WHERE ";
		if(is_numeric($query)){
			$sql .= "`characters`.`Id`";
		} else {
			$sql .= "`characters`.`Name`";
		}
		$sql .= " = :query";
		$sth = $pdo->prepare($sql);
		$sth->execute(array(':query' => $query));
		$results = $sth->fetch(PDO::FETCH_ASSOC);

		return $results;
	}

	function udpateCharacterAttribute($query){
		global $pdo; 
		$possibleKeys = array('FirstName', 'HeadingW', 'HeadingX', 'HeadingY', 'HeadingZ', 'LastName', 'Name', 'Textures0', 'Textures1', 'Textures2', 'Textures3', 'Textures4', 'X', 'Y', 'Z', 'playfield');
		$arguments = array();
		$sql = "UPDATE `characters` SET";
		foreach($_REQUEST as $key => $value){
			if(in_array($key, $possibleKeys)){
				$sql .= ' `characters`.`' . $key . '` = :' . $key;
				$arguments[":".$key] = $value;

			}
		}
		$return = new stdClass; 
		if(sizeof($arguments) > 0){
			if(is_numeric($query)){
				$sql .= ' WHERE `characters`.`Id` = :query';
			} else {
				$sql .= ' WHERE `characters`.`Name` = :query';
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