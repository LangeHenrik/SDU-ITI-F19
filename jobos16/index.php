<?php

// Fix for when application is executed from root directory
$_SERVER["REQUEST_URI"] = str_replace("/jobos16", "", $_SERVER["REQUEST_URI"]);

// Just run the application as normal
include('src/public/index.php');

?>