<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/profile.css'>";
echo "<link rel='stylesheet' href='../../app/css/general.css'>";


    $user = $parameters['user'];
    $username = $user->getUsername();
    $firstname = $user->getFirstname();
    $lastname = $user->getLastname();
    $city = $user->getCity();
    $phonenumber = $user->getPhonenumber();
    $zip = $user->getZip();
    $email = $user->getEmail();



echo "
    <h1 class='header-profile'>Welcome $firstname $lastname</h1>
    <div class='profile-information-wrapper'>
        <div class='username'>$username</div>
        <div class='user-city'>$city, $zip</div>
        <div class='user-phonenumber'>$phonenumber</div>
        <div class='user-email'>$email</div>
    </div>

<form action='logout' method='post'>
    <input class='btn-logout' type='submit' value='Log Out'>
</form>
"

?>