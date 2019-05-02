<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "util/Autoloader.php";
include "util/GlobalUtilFunctions.php";
