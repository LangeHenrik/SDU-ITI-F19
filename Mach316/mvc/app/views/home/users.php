<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>";
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/users.css'>";


$userRenderer = new UserRenderer();
$users = $parameters['users'];

$renderedUsers = $userRenderer->renderUsers($users);



echo "

<div class='main-content'>
    <h1>Users!</h1>
    <div class='users-container'>
        $renderedUsers
    </div>
</div>
"


?>