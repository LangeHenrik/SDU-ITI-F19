<?php include '../app/views/partials/menu.php'; ?>

</div>
<div class="usersTableDiv">
  <div class="headerDiv">List of users:</div>
  <table class="usersTable">
	<th>ID</th>
    <th>Username</th>
    <th>Firstname</th>
    <th>Lastname</th>
	<th>Email</th>
    <?php
	
    foreach ($viewbag as $value)  {
      echo '<tr>';
      echo '<td>'. $value['user_id'] .'</td>';
      echo '<td>'. $value['user_name'] .'</td>';
      echo '<td>'. $value['first_name'] .'</td>';
      echo '<td>'. $value['last_name'] .'</td>';
	  echo '<td>'. $value['email_adress'] .'</td>';
	  
      echo '</tr>';
    }
    ?>
  </table>
</div>
