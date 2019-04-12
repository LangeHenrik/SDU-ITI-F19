<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>";


$user = $parameters['user'];
$username = $user->getUsername();

echo "<h1>Welcome to $username's page</h1>";


?>
