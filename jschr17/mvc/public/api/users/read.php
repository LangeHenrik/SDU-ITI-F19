<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");
include_once(__DIR__ . '/../../../app/core/Database.php');
include_once 'users.php';


$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
switch ($method) {
    case 'GET':
        read();
        break;
    default:
        echo 'Default switch case';
        break;
}

function read(){
    echo json_encode('read method entered');

    //create user array
    $users = array();
    $userList = array();
    
    try {
        //database connection
        $database = new Database;
        $db = $database->getConn();

        //connect to database
        $query = $db->prepare("SELECT * FROM users");
        $query->execute();

        $userList_size = $query->rowCount();

        //get list of users
        $userList = $query->fetchAll();
    } catch(Exception $e){
        echo json_encode('Exception in database connection');
    }
    
    echo json_encode('size of userlist array: ' . $userList_size /*$userList->sizeof*/);
    //check amount of users found
    if ($userList_size > 0){
        //print userlist to see what happens
        echo json_encode(print_r($userList));

        foreach ($userList as $usr) {
            //for each tuple make new user object with the information
            $user = new Users($usr[0],$usr[1]);
            //add user to array of users
            array_push($users, $user);
        }

        //json encode array of users and return it
        $json = json_encode($users, JSON_PRETTY_PRINT);
        http_response_code(200);
        echo($json);
        return($json);
    } else {
        http_response_code(404); //find correct response code
        $msg = json_encode(array("message" => 'no users found.'));
        return $msg;
        
    }
}


//notes
//json_encode($object)
//foreach($object as $key => $value) {...}
//print_r($object)
?>