<?php

function read()
{
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
    } catch (Exception $e) {
        echo json_encode('Exception in database connection');
    }
    // return the database results.... given there are any
    return array($userList, $userList_size);

    
}

//notes
//json_encode($object)
//foreach($object as $key => $value) {...}
//print_r($object)
?>