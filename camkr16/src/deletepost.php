<?php
require "connection.php";

/**
 * @var PDO $conn
 */

session_start();
if (!isset($_SESSION["id"])) {
    header("location: login.php");
}
$userid = $_SESSION["id"];
$postid = $_GET["postid"];

$stmt = $conn->prepare("SELECT user_id, extension FROM post WHERE post_id =:postid");
$stmt->bindParam(":postid", $postid);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    return;
}

if ($userid != $post["user_id"]) {
    http_response_code(401);
    return;
}

$extension = $post["extension"];

$stmt = $conn->prepare("DELETE FROM post WHERE post_id =:postid");
$stmt->bindParam(":postid", $postid);
$stmt->execute();
unlink("pictures/$postid.$extension");

