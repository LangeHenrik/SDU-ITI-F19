<?php

require_once ("../core/database.php");


class showPicModel extends Database {


     public function showPic() {


        if (isset($_SESSION['user_id'])) {
            echo ' <section class="picture-links">
        <div class="wrapper">
          <h2>Pictures</h2> ';

            ?>

          <div id="pictures">
              <?php



              $sql = "SELECT * FROM pictures WHERE img_userid = '{$_SESSION['img_userid']}'";

              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              $pictures = $stmt->fetchAll();

              foreach ($pictures as $pic) {
                ?>
              <li>
                  <figure id="<?php echo $pic['id']; ?>">
                      <b>
                          <figcaption><?php echo $pic["title"] ?>

                          <?php  echo "<img src='../../controllers/" . $pic["image"] . "' height='130' width='220'> ";  ?>

                              <?php echo $pic["description"] ?> <br>
                  </figure>
              </li>

              <?php

            }
          }
        } }
