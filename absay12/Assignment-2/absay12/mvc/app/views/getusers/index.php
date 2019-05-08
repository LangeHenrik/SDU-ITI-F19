<?php include '../app/views/partials/menu.php'; ?>

<?php 
echo '<table id = "customers">
  <tr>
  <th>Username</th>
  <th>Firstname</th>
  <th>Lastname</th>
  <th>City</th>
  <th>Zip</th>
  <th>Email</th>
  </tr>';
  foreach ($result as $value) {
      echo "<tr>";
      echo "<td>" . $value['user_name'] . "</td>";
      echo "<td>" . $value['front_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
      echo "<td>" . $value['city'] . "</td>";
      echo "<td>" . $value['zip_code'] . "</td>";
      echo "<td>" . $value['email_adress'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";

  ?>
