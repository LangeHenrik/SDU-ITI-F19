<?php

include '../app/views/partials/menu.php';

require_once '../app/models/User.php';

if (session_status() == PHP_SESSION_NONE) {
	header("localhost:8080/nifil17/mvc/public/home");
}

?>

<!DOCTYPE html>
<style>

.topnav {
  background-color: #333;
  overflow: hidden;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
	
td, th {
  border: 1px solid #dddddd;
  padding: 8px;
  vertical-align: middle;
  text-align: center;
}

img {
	  max-height: 250px;
}

</style>

<table>
<tr>
<th>
<span>User Id<span>
</th>
<th>
<span>Username</span>
</th>
<th>
<span>First Name<span>
</th>
<th>
<span>Last Name<span>
</th>
<th>
<span>Zip Code<span>
</th>
<th>
<span>City<span>
</th>
<th>
<span>Email<span>
</th>
<th>
<span>Number<span>
</th>
</tr>

<?php

foreach($viewbag['users'] as &$value) {
    echo '<tr>';
    echo '<td>'.$value->user_id.'</td>';
    echo '<td>'.$value->username.'</td>';
    echo '<td>'.$value->first_name.'</td>';
    echo '<td>'.$value->last_name.'</td>';
    echo '<td>'.$value->zip.'</td>';
    echo '<td>'.$value->city.'</td>';
    echo '<td>'.$value->email.'</td>';
    echo '<td>'.$value->number.'</td>';
    echo '</tr>';
}

?>

</table>
</html>
