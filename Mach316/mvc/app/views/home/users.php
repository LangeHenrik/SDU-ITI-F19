<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>";
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/userpage.css'>";


$userRenderer = new UserRenderer();
$users = $parameters['users'];
$renderedUsers = $userRenderer->renderUsers($users);



echo "

<div class='main-content'>
    <h1>Users!</h1>
    <form action='searchusers' method='post'>
        <input type='text' name='searchparam'/>
        <input type='submit'/>
    </form>
    <div class='users-container'>
        $renderedUsers
    </div>
</div>
"


?>