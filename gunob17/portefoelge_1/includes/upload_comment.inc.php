<?php
if (isset($_POST['comment_submit'])) {
session_start();
include 'dbh.php';
$comm = $_POST['comment'];
$comment = htmlspecialchars($comm,ENT_QUOTES) ;
$stmt = $conn->prepare("INSERT INTO comments(idus, picid, username, usercomment)
VALUES (:iduser, :picid, :username, :usercomment)");
if (!$stmt) {
  header('Location: ../picture_site.php?path='.$_GET['name'].'&error=sqlerror');
  exit();
}
$stmt->bindParam(':iduser', $_SESSION['userid']);
$stmt->bindParam(':picid', $_GET['id']);
$stmt->bindParam(':username', $_SESSION['useruid']);
$stmt->bindParam(':usercomment', $comment);

$res = $stmt->execute();
if (!$res){
  header('Location: ../picture_site.php?path='.$_GET['name'].'&error=sqlerror2');
  exit();
}
header('Location: ../picture_site.php?path='.$_GET['name'].'&addcomment=success');
exit();
}
