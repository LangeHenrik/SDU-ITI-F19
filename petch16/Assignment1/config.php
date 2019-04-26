<?php

define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'G6ImCVvpxl');
define('DB_PASSWORD', '0T7zh7tK70');
define('DB_NAME', 'G6ImCVvpxl');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>