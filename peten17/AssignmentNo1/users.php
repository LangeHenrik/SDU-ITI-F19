<?php
  include "header.php";
  include "config.php";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/usersStyle.css">
    <title>Users</title>
  </head>

  <body>

    <div class="content">
      <table>
        <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Phonenumber</th>
           <th>City</th>
           <th>Zipcode</th>
         </tr>
      <?php
        $sql = "SELECT * from users";
        $stmt = $conn->query($sql);
        $stmt->execute();

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

          echo "<tr>";
            echo "<td>" . $row['firstname'] ." ". $row['lastname']. "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phonenumber'] . "</td>";
            echo "<td>" . $row['city'] ."</td>";
            echo "<td>" . $row['zipcode'] . "</td>";
          echo "</tr>";

         }
        // for ($i=0; $row < ; $i++) {
        //   // code...
        // }



      ?>



      </table>
      <?php
        $sql = "SELECT "

       ?>

    </div>

  </body>
</html>
