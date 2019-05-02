<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["logged_in"])) {
  header("Location:Login.php");
}
?>

<?php
  require_once 'includes/dbconfig.php';

  try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",
  $username,
  $password,
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $query = $conn->prepare("SELECT * FROM post ORDER BY time_created DESC LIMIT 20;");

  $query->execute();
  $query->setFetchMode(PDO::FETCH_ASSOC);
  $posts = $query->fetchAll();
} catch (PDOException $e) {
  $error = $e->getMessage();
  $posts = array();
  echo "Error: " . $error;
}

$conn = null;
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pictures</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Posts.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="Pictures.php">Pictures</a></li>
        <li><a href="Users.php">Users</a></li>
        <li><a href="UploadPic.php">Upload Picture</a></li>
        <li><a href="includes/Logout.php">Logout</a></li>
      </ul>
    </nav>
<!-- her kommer der eventuelt et banner billede-->
<!--<div class="content" id="content">-->
  <div class="wrapper">
  <?php
      foreach ($posts as $post) {
        create_post_article($post['picture'], $post['header'], $post['description']);
      }
   ?>
 </div>
<!--</div>-->
  <!--  <div class="wrapper">
      <article class="pic-text">
        <h2>En titel</h2>
        <p>Bare en masse text som der ikke er noget værd det er bare for at have noget text at arbejde med. Nu er jeg ved at løbe tør for ideer om hvad jeg kan srkive, men jeg bliver ved indtil jeg ved jeg har mere end rigeligt.</p>
        <p> Nu er det sikkert ved at ligne at der står en del text, men det hele er bare sludder sladder. Jeg tager lige en lille smule mere med bare for at være sikker, man ved jo aldrig, også selvom det kun er fylde text.</p>
      </article>

      <img class="img-artc-pic" src="billeder/2sfin4.jpg" alt="meme billede">
    </div> -->

  </body>
</html>

<?php
function create_post_article($picture, $header, $text){

  //echo '<div class="wrapper">';
  echo '<article class="pic-text">';
  echo '  <h2>'.$header.'</h2>';
  echo '  <p>' .$text.' </p>';
  echo '</article>';
  echo '  <img alt="Failure to load picture, What did you do?" class="img-artc-pic" src="'.$picture.'" />';
  echo '<br>';
  //echo '</div>';

}

 ?>
