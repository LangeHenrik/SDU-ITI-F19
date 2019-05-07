<?php 

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);

echo "<a href = ' " . $root . "/omhaw16/mvc/public/index.php'>Home </a>";

echo "<a href = ' " . $root . "/omhaw16/mvc/app/views/home/login.php'> Login  </a>";

echo "<a href = ' " . $root . "/omhaw16/mvc/app/views/home/register.php'> Register </a>";

echo "<a href = ' " . $root . "/omhaw16/mvc/app/views/home/upload.php'> Upload </a>";

echo "<a href = ' " . $root . "/omhaw16/mvc/app/views/home/myposts.php'> My Posts</a>";

echo "<br><br>";

// echo "<a href='styling/stylelight.css'> Night mode </link>";

?>