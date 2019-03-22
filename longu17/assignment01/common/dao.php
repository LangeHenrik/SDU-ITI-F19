<?php
/**
 * Created by PhpStorm.
 * User: Loc
 * Date: 2019-03-09
 * Time: 23:57
 */
$dbhost = "127.0.0.1";
$dbname = "profiles";
$dbuser = "root";
$dbpass = "";
try{
  // Set out internal db handle with the dsn values from above
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  // if the db type is mySQL, set some attributes
  $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Conecctnion faild";
    } else{
    //echo "Connected to DB<br>";
}
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}
?>
