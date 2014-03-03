<?php
    define("GM_REQUIRED", True);
	require_once('../config.php');

    isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : printNoResults();

    switch($action){
        case "getUserById":
            isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : printNoResults();
            echo(json_encode(getUserById($userId)));
            break;
        case "getUserByUsername":
            isset($_REQUEST['username']) ? $username = $_REQUEST['username'] : printNoResults();
            echo(json_encode(getUserByUsername($username)));
            break;
        case "getAllUsers":
            echo(json_encode(getAllUsers()));
            break;
        case "getAllUsersTableJSON":
            echo(json_encode(getAllUsersTableJSON()));
            break;
    }
    die();

    function getUserById($userId){
        global $pdo;
        $sth = $pdo->prepare("SELECT `login`.`Id`, `login`.`CreationDate`, `login`.`Email`, `login`.`FirstName`,
                            `login`.`LastName`, `login`.`Username`, `login`.`Password`, `login`.`AllowedCharacters`, 
                            `login`.`Flags`, `login`.`AccountFlags`, `login`.`Expansions`, `login`.`GM`
                            FROM `login` WHERE `login`.`Id` = :userId");
        $sth->execute(array(':userId' => $userId));
        $results = $sth->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    function getUserByUsername($username){
        global $pdo;
        $sth = $pdo->prepare("SELECT `login`.`Id`, `login`.`CreationDate`, `login`.`Email`, `login`.`FirstName`,
                            `login`.`LastName`, `login`.`Username`, `login`.`Password`, `login`.`AllowedCharacters`, 
                            `login`.`Flags`, `login`.`AccountFlags`, `login`.`Expansions`, `login`.`GM`
                            FROM `login` WHERE `login`.`Username` = :username");
        $sth->execute(array(':username' => $username));
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


	function printNoResults(){
		echo(json_encode(array()));
		die();
	}
?>