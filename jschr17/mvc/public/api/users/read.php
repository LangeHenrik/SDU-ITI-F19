<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");
include_once(__DIR__ . '/../../../app/core/Database.php');


function read(){
    echo json_encode('read method entered');
    //database connection
    $database = new Database;
    $db = $database->getConn();

    //create user array
    $users = array();

    //connect to database
    $query = $db->prepare("SELECT * FROM users");
    $query->execute();

    //get list of users
    $userList = array();
    $userList = $query->fetchAll();

    //check amount of users found
    if ($userList->sizeof > 0){
        //print userlist to see what happens
        echo '<pre>'; echo print_r($userList); echo '</pre>';

        foreach ($userList as $usr) {
            //for each tuple make new user object with the information
            $user = new User($usr[0],$usr[1]);
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