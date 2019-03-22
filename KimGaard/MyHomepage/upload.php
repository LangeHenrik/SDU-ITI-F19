<?php
require "header.php";
?>

<main>
  <script src="js\ajaxLoadMoreImagesOnScroll.js">
  //AJAX Call to load more images on scroll
</script>

<?php
// ***** UPLOAD FORM *****
if (isset($_SESSION['userId'])) {
  include 'includes/dbh.inc.php';
  echo '
  <div class="space">
  </div>

  <form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
  <input type="file" name= "file" value="">
  <button class="button" type="submit" name="submit-upload">UPLOAD</button>
  </form>
  <div class="space">
  </div>';
echo '<h3>Scroll down to expirence the awesomeness of an AJAX call!</h3>';
  //This part loads 2 images BEFORE the AJAX call
  echo '<div id="ajax" class="image-container">';

  $stmt = $connect -> prepare("SELECT * from images order by idImg desc limit 2 ");
  $stmt -> execute();

  if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      echo '<div class = "images">';
      echo '<p>Uploaded by: '.$row['uidUsers'].'</p>';
      echo '<br>';

      echo '<img src="'.$row['path'].'" alt="'.$row['name'].'">';
      echo '</div>';
    }
    $connect = null;
  }
  echo '</div>';

}

else {
  echo '<div class="space"></div>';
  echo '<h3>You need to <a href="login.php">login</a> to be able to watch the content of this page!</h3>';
}

?>
</main>

<!-- NO FOOTER 'CAUSE OF BROKEN REASONS -->
<?php
//  require "footer.php";
?>
