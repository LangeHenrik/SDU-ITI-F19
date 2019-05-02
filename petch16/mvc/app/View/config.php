<?php

define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'n2zfhblJbg');
define('DB_PASSWORD', 'M8iIC7OZoq');
define('DB_NAME', 'n2zfhblJbg');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>