<?php

    isset($_REQUEST['id']) ? $itemId = $_REQUEST['id'] : printNoResults();
    isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

    switch($action){
        case "getItem":
            echo(json_encode(getItem($itemId)));
            break;
        case "getItemImageURL":
            echo(getItemImageURL($id));
            break;
        case "getItemImageHTML":
            echo(getItemImageHTML($id));
            break;
    }
    printNoResults();
    die();

    function getUserItems($uid){

    }

    function getItem($itemId){
        $item = array();
        $xdoc = new DOMDocument();
        $xdoc->load('itemsicons.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }
        $nodeList = $xpath->query('/item2icon/cellao[@id="' . $itemId . '"]', $xdoc);
        foreach ($nodeList as $node) {
            $item = array('id' => $node->getAttribute('id'), 'name' => $node->getAttribute('name'), 'img' => $node->getAttribute('img'));
        }
        return $item;
    }

    function getItemImageHTML($item){
        if(!is_array($item)){
            $item = getItem($itemId);
        }
        //TODO: I don't like pulling from auno...
        return "<img src='http://auno.org/res/aoicons/".$item['img'].".gif' title='".$item["name"]."' alt='".$id_num."'>";
    }

    function getItemImageURL($item){
        if(!is_array($item)){
            $item = getItem($itemId);
        }
        //TODO: I don't like pulling from auno...
        return "http://auno.org/res/aoicons/".$item['img'].".gif";
    }

    function printNoResults(){
        echo(json_encode(array()));
        die();
    }
?>