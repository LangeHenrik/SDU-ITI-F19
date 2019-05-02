<?php

require_once ("../../Core/database.php");


class showPicModel extends Database {


     public function showPic() {


        if (isset($_SESSION['u_id'])) {
            echo ' <section class="picture-links">
        <div class="wrapper">
          <h2>Pictures</h2> ';

            ?>

          <div id="pictures">
              <?php



              $sql = "SELECT * FROM pictures WHERE userid = '{$_SESSION['u_id']}'";

              //$sql = "SELECT * FROM pictures ORDER BY userid DESC LIMIT 20;";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              $pictures = $stmt->fetchAll();

              // if ($pictures !== null) {
              foreach ($pictures as $pic) {
                ?>
              <li>
                  <figure id="<?php echo $pic['id']; ?>">
                      <b>
                          <figcaption><?php echo $pic["title"] ?>
                          <!-- Fejl er her -->

                          <?php  echo "<img src='../../controllers/" . $pic["image"] . "' height='130' width='220'> ";  ?>

                              <?php echo $pic["description"] ?> <br>
                  </figure>
              </li>

              <?php

            }
          }
        } }