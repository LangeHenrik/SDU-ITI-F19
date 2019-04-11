<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/general.css'>";
echo "<link rel='stylesheet' href='../../app/css/userpage.css'>";
;

$user = $parameters['user'];
$username = $user->getUsername();

echo "<h1>Welcome to $username's page</h1>"


?>