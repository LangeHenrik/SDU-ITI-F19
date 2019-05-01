<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");

//database connection
$database = new Database;
$db = $database->getConn();

//create user array
$users = array();

//connect to database
$getUsers = $db->prepare("SELECT * FROM users");
$getusers->execute();
//get list of users
$userList = $getUsers->fetchAll();
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


/* TODO
add checks for amount of users, set response based on check results
add function to be called
 */

//notes
//json_encode($object)
//foreach($object as $key => $value) {...}
//print_r($object)
?>