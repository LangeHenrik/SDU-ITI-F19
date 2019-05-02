<?php
include '../app/views/partials/navigationbar.php';

?>

<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>
    <link rel='stylesheet' href='/Mach316/mvc/public/css/registerform.css'>
    <script src='/Mach316/mvc/public/js/listeners.js'></script>

</head>
</html>


<?php
echo "<script src='/Mach316/mvc/public/js/formvalidation.js'></script>";



echo "
<div class='main-content'>
    <h1>Welcome to AEkόvεs!</h1>
    <div class='register-form-wrapper'>
        <form class='register-form' method='post' action='registeruser' onsubmit='return validateForm()'>
            <div class='input-block' id='input-block-username'>
                 <div>
                    <input id='input-username' type='text' name='username' placeholder='Username'/>
                </div>
            </div>
            <div class='input-block' id='input-block-password'>
                <div>
                    <input type='password' id='input-password' name='password' placeholder='Password'/>
                </div>
            </div>
            <div class='input-block' id='input-block-repeated-password'>
                <div>
                    <input type='password'  id='input-repeated-password' name='repeated-password' placeholder='Repeat password'/>
                 </div>
            </div>
            <div class='input-block' id='input-block-firstname'>
                <div>
                    <input type='text' id='input-firstname' name='firstname' placeholder='Firstname'/>
                </div>
            </div>
            <div class='input-block' id='input-block-lastname'>
                <div>
                    <input type='text' id='input-lastname' name='lastname' placeholder='Lastname'/>
                </div>
            </div>
            <div class='input-block' id='input-block-city'>
                 <div>
                    <input type='text' id='input-city' name='city' placeholder='City'/>
                </div>
            </div>
            <div class='input-block' id='input-block-zip'>
                <div>
                    <input type='text' name='zip' id='zip-input' placeholder='Zip'/>
                </div>
            </div>
            <div class='input-block' id='input-block-phonenumber'>
                <div>
                    <input type='text' id='input-phonenumber' name='phonenumber' placeholder='Phonenumber'/>
                </div>
            </div>
            <div class='input-block' id='input-block-email'>
                <div>
                    <input id='input-email' type='text' name='email' placeholder='Email'/>
                </div>
            </div>
            <input class='btn-registration' type='submit' value='Register'>
        </form>
    </div>
    
 </div>


";


?>

