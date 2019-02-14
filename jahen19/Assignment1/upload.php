<?php
session_start();

// check whether user is logged in
if (!isset($_SESSION['username'])) {
    die("Failed: you need to log in first.");
}

// establish sql connection
require "sql.php";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!is_dir($upload_path)) {
    if (!mkdir($upload_path, 0700, true)) {
        die('Failed to create upload folder');
    }
}

$header = $_POST['header'];
$subtext = $_POST['subtext'];

// if the header is too long, only use the first 50 chars (database does not support more)
if (strlen($header) > 50) {
    $header = substr($header,0,50);
}

// arbitrarily limit the subtext size (otherwise the user may submit an infinitely long text, filing up the database)
if (strlen($subtext) > 1000) {
    $subtext = substr($subtext,0,1000);
}

// PHP temporary saves the files submitted in the form in the associative array $_FILES
$filename = $_FILES["userfile"]["name"];

// Isolate the file type extension
$extension = substr($filename, strpos($filename,"."), strlen($filename)-1);

// Check for allowed filetype
if(!in_array($extension, $allowed_filetypes)) {
  die("Failed: Filetype not allowed");
}
// Check if file size is below the limit
if(filesize($_FILES["userfile"]["tmp_name"]) > $max_filesize) {
  die("Failed: File too big");
}

// generate new filename based on random string and extension
$filename =  generateRandomString(12) . $extension;

// check if filename already used
try  {
    $sql = "SELECT filename FROM Images WHERE filename = :filename";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":filename", $filename);
    $statement->execute();
    $result = $statement->fetchAll();
    if ($result && $statement->rowCount() > 0) {
        // filename already used
        die("Failed: Internal server error");
    }

    // add entry to database
    // use prepared statement to avoid any SQL injections
    // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    $user = $_SESSION['username'];
    $sql = "INSERT INTO Images (filename, user, header, text, date) values (:filename,:user,:header,:subtext, NOW())";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":filename", $filename);
    $statement->bindParam(":user", $user);
    $statement->bindParam(":header", $header);
    $statement->bindParam(":subtext", $subtext);
    $statement->execute();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

// Copy the file from PHP's buffer to the server
if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $upload_path . $filename)) {
    // send url of image back to user
    echo "OK: " . '/serve.php?filename=' . $filename;
} else {
    die("Failed to PHP move file. Please try again.");
}
?>
