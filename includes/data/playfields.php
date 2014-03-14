<?php
	
	isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

	switch($action){
		case "getPlayfield":
			isset($_REQUEST['query']) ? $query = $_REQUEST['query'] : printNoResults();
			echo(json_encode(getPlayfield($query)));
			break;
		case "getPlayfieldName":
			isset($_REQUEST['id']) ? $playfieldId = $_REQUEST['id'] : printNoResults();
			echo(json_encode(getPlayfield($playfieldId)));
			break;
		case "getAllPlayfields":
			echo(json_encode(getAllPlayfields()));
			break;       
	}
	die();

	function getPlayfield($query){
		global $pdo;

		$sql = "SELECT `playfields`.`Id`, `playfields`.`Expansion`, `playfields`.`Disabled`, `playfields`.`Name`
							FROM `playfields` WHERE `playfields`.");
		
		if(is_numeric($query)){
			$sth = $pdo->prepare($sql . "`Id` = :query");
		} else {
			$sth = $pdo->prepare($sql . "`Name` = :query");
		}

		$sth->execute(array(':query' => $query));
		$results = $sth->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
	

	function getPlayfieldName($playfieldId){
		global $pdo;

		$sth = $pdo->prepare("SELECT `playfields`.`Id`, `playfields`.`Expansion`, `playfields`.`Disabled`, `playfields`.`Name`
							FROM `playfields` WHERE `playfields`.`Id` = :query");

		$sth->execute(array(':query' => $playfieldId));
		$results = $sth->fetch(PDO::FETCH_ASSOC);
		return $results;
	}

	function getAllPlayfields(){
		global $pdo;

		$sth = $pdo->prepare("SELECT `playfields`.`Id`, `playfields`.`Expansion`, `playfields`.`Disabled`, `playfields`.`Name`
							FROM `playfields`");
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>