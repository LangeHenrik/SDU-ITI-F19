<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-19
 * Time: 12:32
 */

require 'DatabaseManager.php';

$query = $_GET['searchParam'];
$users = searchUsers($query);


$userResults = array();



foreach($users as $user) {


    $userResult = new \stdClass();

    $username = $user['username'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $city = $user['city'];

    $userResult->username = $username;
    $userResult->firstname = $firstname;
    $userResult->lastname = $lastname;
    $userResult->city = $city;

    $jsonUser = json_encode($userResult);
    array_push($userResults, $userResult);

}

$userResults = json_encode($userResults);

echo $userResults;