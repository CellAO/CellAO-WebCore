<?php
	
    isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

    switch($action){
        case "getPlayfield":
        	isset($_REQUEST['id']) ? $playfieldId = $_REQUEST['id'] : printNoResults();
            echo(json_encode(getPlayfield($playfieldId)));
			break;
		case "getAllPlayfields":
            echo(json_encode(getAllPlayfields()));
			break;       
    }
    die();

	function getPlayfield($playfieldId){
		$playfield = array();
        $xdoc = new DOMDocument();
        $xdoc->load('Playfields.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }
        $nodeList = $xpath->query('/Playfields/Playfield[@id="' . $playfieldId . '"]', $xdoc);
        foreach ($nodeList as $node) {
            $playfield = array('id' => $node->getAttribute('id'), 'expansion' => $node->getAttribute('expansion'), 'disabled' => $node->getAttribute('disabled'), 'name' => $node->childNodes->item(1)->nodeValue);
        }
        return $playfield;
	}

	function getPlayfieldName($playfield){
		if(!is_array($playfield)){
			$playfield = getPlayfield($playfield);
		}
		return $playfield['name'];
	}

	function getAllPlayfields(){
		$playfieldList = array();
        $xdoc = new DOMDocument();
        $xdoc->load('Playfields.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }
        $nodeList = $xpath->query('/Playfields/Playfield', $xdoc);
        foreach ($nodeList as $node) {
            $playfieldList[] = array('id' => $node->getAttribute('id'), 'expansion' => $node->getAttribute('expansion'), 'disabled' => $node->getAttribute('disabled'), 'name' => $node->childNodes->item(1)->nodeValue);
        }
        return $playfieldList;
	}

	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>