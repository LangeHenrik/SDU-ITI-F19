<?php
$method = $_SERVER['REQUEST_METHOD'];

header("Content-type: application/json");

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$firstPathName = $request[0];

if($firstPathName == "getPictures") {
    echo "<h1>Get Pictures</h1>";
} else {
    echo json_encode(array('Method' => $method));
}

?>