
<?php
session_start();
include "includes/dbh.php";
if (isset($_SESSION['userid'])) {
    $picturecount = intval($_GET['pictureCount']);

    $stmt = $conn -> prepare("SELECT * from pictures order by idpic desc limit $picturecount");
    $stmt -> execute();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class = "image">';
            echo '<p>'.$row['username'].'</p>';
            echo '<br>';
            echo '<a href = "picture_site.php?path='.$row['name'].'">';
            echo '<img class="images" src="'.$row['path'].'" alt="'.$row['name'].'">';
            echo '</a></div>';
        }
    }
}
exit();
?>
