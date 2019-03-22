<?php
include_once "includes/db_config.php";

if (isset($_POST['id'])) {
    $picID = $_POST['id'];
    $sql = "DELETE FROM pictures WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($picID));
}

?>