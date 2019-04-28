<?php

define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'EryhUN5IuY');
define('DB_PASSWORD', '6YuPTfiZux');
define('DB_NAME', 'EryhUN5IuY');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>