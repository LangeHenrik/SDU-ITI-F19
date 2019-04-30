<style> <?php include_once('../templates/css/ajax.css')?> </style>
<?php require_once('../common/dao.php'); ?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = $_GET['q'].'%';
try {
  $q = $_GET['q'].'%';
  $stmt = $conn->prepare("SELECT * FROM user where first_name LIKE '$q';");
  $stmt->execute(); 
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
  echo 'Error: ' . $exception->getMessage();
}
if($row) 
{
echo "<table>
<tr>
<th>UserID</th>
<th>Username</th>
<th>First Name</th>
<th>Last Name</th>
<th>Zip</th>
<th>City</th>
<th>Email</th>
<th>Phonenumber</th>
</tr>";
foreach($row as $user) 
{
    echo "<br>";
    echo "<tr>";
    echo "<td>" . $user['UserID'] . "</td>";
    echo "<td>" . $user['Username'] . "</td>";
    echo "<td>" . $user['First_Name'] . "</td>";
    echo "<td>" . $user['Last_Name'] . "</td>";
    echo "<td>" . $user['Zip'] . "</td>";
    echo "<td>" . $user['City'] . "</td>";
    echo "<td>" . $user['Email'] . "</td>";
    echo "<td>" . $user['Phone_Number'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
}
?>
</body>
</html>

