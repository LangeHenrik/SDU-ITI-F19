
<?php
include "includes/dbh.php";
$picturecount = intval($_GET['pictureCount']);

$stmt = $conn -> prepare("SELECT * from pictures order by idpic desc limit $picturecount");
$stmt -> execute();
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class = "image">';
    echo '<p>'.$row['username'];
    echo '<br>';
    echo '<img class="images" src="'.$row['path'].'" alt="'.$row['name'].'">';
    echo '</div>';
  }
}
?>
