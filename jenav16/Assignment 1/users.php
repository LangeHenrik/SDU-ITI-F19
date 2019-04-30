<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ITI 1.0</title>
</head>
<body>
<?php
require "db_config.php";
require "database.php";
if (isset($POSTUSERS)) {
    $stmt = $conn->prepare("SELECT username, firstName, lastName, zip, city, emailAddress, phoneNumber FROM Users");
    $stmt->execute();
    $executed = $stmt->fetchAll();
    for($i = 0; $i < count($executed); $i++) {
        echo $executed[$i]["username"].' - '.$executed[$i]["firstName"].' - '.$executed[$i]["emailAddress"].' - '.$executed[$i]["phoneNumber"]."<br><br>";
    }
}
?>
<button onclick='window.history.back()'>Back to the Asset screen</button>
</body>
</html>