<?php
include "header.php"; // adds header from other pages.
include "config.php";

if (isset($_POST["addPost"])) {
  header("location:uploadImg.php");
}

$sql = "SELECT * from posts";

$stmt = $conn->query($sql);
$stmt->execute();



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/startpageStyle.css">
    <title>Homepage</title>
  </head>



  <body>
    <form class="addPost" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="submit" name="addPost" value="Add post">
    </form>
    <div class="content">


<?php
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='post_container'>";
        echo "<p>".$row['comment']."</p>";
        echo "<img align='middle' src=".$row['image_path'].">";
    echo "</div>";
   }
?>
  </div>


  </body>
</html>
