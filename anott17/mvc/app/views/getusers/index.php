<?php include '../app/views/partials/menu.php'; ?>

<div class="usersTableDiv">
  <div class="headerDiv">Here you can search for a specific user name for more information:</div>
  <form class = "searchForUsersForm">
    User name: <input type="text" onkeyup="showUser(this.value)">
  </form>
  <div id="searchResults">

  </div>

</div>
<div class="usersTableDiv">
  <!-- <h2>Here is a list of all users:</h2> -->
  <div class="headerDiv">Here is a list of all users:</div>
  <table class="usersTable">
    <th>Username</th>
    <th>Frontname</th>
    <th>Lastname</th>
    <?php
    foreach ($viewbag as $value)  {
      echo '<tr>';
      echo '<td>'. $value['user_name'] .'</td>';
      echo '<td>'. $value['front_name'] .'</td>';
      echo '<td>'. $value['last_name'] .'</td>';
      echo '</tr>';
    }
    ?>
  </table>
</div>
