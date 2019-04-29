<?php
include_once 'UserTable.php';
$user = new UserTable();
$array = array("username", "fname", "lname",
    "city", "zip",
    "email", "phone", "pwd");
//$username = 'andk';
$results= $user ->select($array);
//var_dump($results);

//include_once 'ImagesTable.phpe.php';
//$image = new ImagesTable();
//$array = array("header"=>"hey", "text"=>"mpla mpla", "id_user"=>"13", "image"=>"uploads/");
//$isInsert = $image->insert($array);

//$user = new UserTable();
//$u_array = array("username"=>"nik", "fname"=>"nik", "lname"=>"nik",
//    "city"=>'aar', "zip"=>"9999",
//    "email"=>'a@a', "phone"=>'000', "pwd"=>"0000");
//$isInsert = $user ->insert($u_array);
