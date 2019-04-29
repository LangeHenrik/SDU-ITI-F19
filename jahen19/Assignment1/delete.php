<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Failed: 400 - Bad Request");
}

// check whether user is logged in
if (!isset($_SESSION['username'])) {
    die("Failed: you need to log in first.");
}

$filename = $_POST['filename'];
if (!isset($filename)) {
    die("Failed: no file specified");
}

// establish sql connection
require "sql.php";

try  {
    // remove database entry
    // use prepared statement to avoid any SQL injections
    // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    $sql = "DELETE FROM Images WHERE filename = :filename AND user = :user LIMIT 1";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":filename", $filename);
    $statement->bindParam(":user", $_SESSION['username']);
    $statement->execute();

    // check if there actually was such a file in the database
    if ($statement->rowCount() == 1) {
        // delete (unlink) file
        unlink($upload_path . $filename);
        echo "OK";
    }
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>
