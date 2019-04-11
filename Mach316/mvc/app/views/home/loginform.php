<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/loginform.css'>";

$message = $parameters['message'];

echo "
    <div class='login-form-wrapper'>
        <div>$message</div>
        <form  method='post' class='login-form' action='login'>
            <div class='input-block'>
                <label >Username</label>
                <input type='text' name='username'>
            </div>
            <div class='input-block'>
                <label>Password</label>
                <input type='password' name='password'>
            </div>
            <input type='submit' value='Login'/>
        </form>
        <form method='post' action='register'>
            <input type='submit' value='Register'/>
         </form>
    </div>
       ";

?>