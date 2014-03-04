<?php
    //It looks like the itemicons.xml file has duplicates and is missing some entries.
    //Might need to start looking at performing queries against the SQL DB.
    isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

    switch($action){
        case "getItem":
            isset($_REQUEST['query']) ? $queryString = $_REQUEST['query'] : printNoResults();
            echo(json_encode(getItem($queryString)));
            break;
        case "getItemImageURL":
            isset($_REQUEST['query']) ? $queryString = $_REQUEST['query'] : printNoResults();
            echo(json_encode(getItemImageURL($queryString)));
            break;
        case "getItemImageHTML":
            isset($_REQUEST['query']) ? $queryString = $_REQUEST['query'] : printNoResults();
            echo(json_encode(getItemImageHTML($queryString)));
            break;
    }
    die();

    function getUserItems($uid){

    }

    function getItem($queryString){
        $item = array();
        $xdoc = new DOMDocument();
        $xdoc->load('itemsicons.xml');
        $xpath = new DOMXPath($xdoc); 
        if(!$xdoc) {
            die("error");
        }

        if(is_int($queryString)){
            $nodeList = $xpath->query('/item2icon/cellao[@id="' . $queryString . '"]', $xdoc);
            foreach ($nodeList as $node) {
                $item[] = array('id' => $node->getAttribute('id'), 'name' => $node->getAttribute('name'), 'img' => $node->getAttribute('img'));
            }
            return $item;
        } // Else, if it's a string, perform a text search. 
    }

    function getItemImageHTML($queryString){
        if(!is_array($queryString)){
            $searchResults = getItem($queryString);
        }
        $returnData = array();
        foreach($searchResults as $index => $item){
            $returnData[] = "<img src='http://auno.org/res/aoicons/".$item['img'].".gif' title='".$item["name"]."' alt='" . $item['name'] ."'>";
        }
        return $returnData;
    }

    function getItemImageURL($item){
        if(!is_array($item)){
            $item = getItem($item);
        }
        //TODO: I don't like pulling from auno...
        return "http://auno.org/res/aoicons/".$item['img'].".gif";
    }

    function printNoResults(){
        echo(json_encode(array()));
        die();
    }
?>