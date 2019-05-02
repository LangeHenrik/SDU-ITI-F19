<?php
declare(strict_types=1);

if (!preg_match("/\/api\//", $_SERVER["REQUEST_URI"])) {

    readfile("actualindex.html");

    return;
}

require "../app/index.php";