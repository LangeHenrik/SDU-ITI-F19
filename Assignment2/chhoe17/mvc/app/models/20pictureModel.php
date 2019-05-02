<?php

require_once ("../../Core/database.php");


class show20PicModel extends Database {

    public function show20Pic() {


        
				
				
				
				?>

				<div id="pictures">
				<h2>20 Latest pictures</h2> ';
                <?php



                $sql = "SELECT * FROM pictures ORDER BY id DESC LIMIT 20;";

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



}