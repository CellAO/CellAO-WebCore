<?php
	
    isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

    switch($action){
        case "getStat":
        	isset($_REQUEST['id']) ? $statId = $_REQUEST['id'] : printNoResults();
            echo(json_encode(getStat($statId)));
			break;
		case "getStatName":
        	isset($_REQUEST['id']) ? $statId = $_REQUEST['id'] : printNoResults();
            echo(json_encode(getStatName($statId)));
			break;
		case "getAllStats":
            echo(json_encode(getAllStats()));
			break;       
    }
    die();

    function getStat($statId){
		$stat = array();
        $xdoc = new DOMDocument();
        $xdoc->load('Stats.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }
        $nodeList = $xpath->query('/Stats/Stat[@id="' . $statId . '"]', $xdoc);
        foreach ($nodeList as $node) {
            $stat = array('id' => $node->getAttribute('id'), 'name' => $node->getAttribute('Name'), 'default' => $node->childNodes->item(3)->nodeValue, 'fullName' => $node->childNodes->item(1)->nodeValue);
        }
        return $stat;
	}

	function getStatName($stat){
		if(!is_array($stat)){
			$stat = getStat($stat);
		}
		return array("name" => $stat['name'], "fullName" => $stat['fullName']);
	}

	function getAllStats(){
		$stats = array();
        $xdoc = new DOMDocument();
        $xdoc->load('Stats.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }
        $nodeList = $xpath->query('/Stats/Stat', $xdoc);
        foreach ($nodeList as $node) {
            $stats[] = array('id' => $node->getAttribute('id'), 'name' => $node->getAttribute('Name'), 'default' => $node->childNodes->item(3)->nodeValue, 'fullName' => $node->childNodes->item(1)->nodeValue);
        }
        return $stats;
	}

	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>