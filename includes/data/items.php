<?php
	require_once('../config.php');
	isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

	switch($action){
		// case "getItem":
		//     isset($_REQUEST['query']) ? $queryString = $_REQUEST['query'] : printNoResults();
		//     echo(json_encode(getItem($queryString)));
		//     break;

		case "searchItems":
			isset($_REQUEST['query']) ? $queryString = $_REQUEST['query'] : printNoResults();
			isset($_REQUEST['limit']) ? $limit = $_REQUEST['limit'] : $limit = 5;
			echo(json_encode(searchItems($queryString, $limit)));
			break;
		case "spawnItemForUser":
			//This is not secure at the moment. Might need to consider moving it and other item administrative functions to their own file. 
			isset($_REQUEST['itemId']) ? $itemId = $_REQUEST['itemId'] : printNoResults();
			isset($_REQUEST['ql']) ? $ql = $_REQUEST['ql'] : $printNoResults();
			isset($_REQUEST['userId']) ? $userId = $_REQUEST['userId'] : $printNoResults();
			echo(json_encode(spawnItemforUser($itemId, $ql, $userId)));
			break;
			
	}
	die();

	function searchItems($query, $limit){
		global $pdo;
		$sql = "SELECT `itemnames`.`id`, `itemnames`.`Name`, `itemnames`.`ItemType`, `itemnames`.`Icon`
				FROM `itemnames` 
				WHERE `itemnames`.`Name` 
				LIKE :query 
				LIMIT %d";
		$sql = sprintf($sql, $limit);
		$sth = $pdo->prepare($sql);
		$sth->execute(array(':query' => '%' . $query . '%'));
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	function spawnItemForUser($itemId, $ql, $userId){

	}

	// function getUserItems($uid){

	// }

	// function getItem($queryString){
	// 	$item = array();
	// 	$xdoc = new DOMDocument();
	// 	$xdoc->load('itemsicons.xml');
	// 	$xpath = new DOMXPath($xdoc); 
	// 	if(!$xdoc) {
	// 		die("error");
	// 	}

	// 	if(is_int($queryString)){
	// 		$nodeList = $xpath->query('/item2icon/cellao[@id="' . $queryString . '"]', $xdoc);
	// 		foreach ($nodeList as $node) {
	// 			$item[] = array('id' => $node->getAttribute('id'), 'name' => $node->getAttribute('name'), 'img' => $node->getAttribute('img'));
	// 		}
	// 		return $item;
	// 	} // Else, if it's a string, perform a text search. 
	// }

	// function getItemImageHTML($queryString){
	// 	if(!is_array($queryString)){
	// 		$searchResults = getItem($queryString);
	// 	}
	// 	$returnData = array();
	// 	foreach($searchResults as $index => $item){
	// 		$returnData[] = "<img src='http://auno.org/res/aoicons/".$item['img'].".gif' title='".$item["name"]."' alt='" . $item['name'] ."'>";
	// 	}
	// 	return $returnData;
	// }

	// function getItemImageURL($item){
	// 	if(!is_array($item)){
	// 		$item = getItem($item);
	// 	}
	// 	//TODO: I don't like pulling from auno...
	// 	return "http://auno.org/res/aoicons/".$item['img'].".gif";
	// }

	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>