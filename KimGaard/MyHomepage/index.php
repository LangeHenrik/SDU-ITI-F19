<?php
require "header.php";
?>

<main>
  <section class="index-banner">
    <div class="vertical-center">
      <h2>velkommen til <br> Loppebixen</h2>
      <h1>Salg af antik-, genbrug- og loppefund.</h1>
    </div>
  </section>

  <div class="wrapper">
    <section class="index-linkboxes">
      <a href="#">
        <div class="index-boxlink-square">
          <h3>Varer</h3>
        </div>
      </a>
      <a href="#">
        <div class="index-boxlink-rectangle">
          <h3>Nyheder</h3>
        </div>
      </a>
      <a href="#">
        <div class="index-boxlink-rectangle">
          <h3>Inspiration</h3>
        </div>
      </a>
      <a href="#">
        <div class="index-boxlink-square">
          <h3>Kontakt</h3>
        </div>
      </a>
    </section>
  </div>
  <?php
  if (isset($_SESSION['userId'])) {

    include 'includes/dbh.inc.php';
    echo '<h3>List of users who signed up!</h3>';
    $sql = "SELECT uidUsers FROM users";
    $stmt = $connect->prepare($sql);
    $stmt -> execute();
    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class = "">';

        echo '<p>'.$row['uidUsers'].'</p>';
        echo '<br>';
        echo '</div>';
      }
    }
  }
  ?>
</main>

<?php
require "footer.php";
?>
