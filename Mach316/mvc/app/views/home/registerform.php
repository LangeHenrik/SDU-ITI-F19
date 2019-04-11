<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/general.css'>";
echo "<link rel='stylesheet' href='../../app/css/registerform.css'>";

$message = $parameters['message'];

echo "
<div class='main-content'>
    <h1>Welcome to AEkόvεs!</h1>
    <div class='register-form-wrapper'>
        <form class='register-form' method='post' action='registeruser'>
            <div class='input-block'>
                 <div>
                    <input id='input-username' type='text' name='username' placeholder='Username'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='password' name='password' placeholder='Password'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='password' name='repeated-password' placeholder='Repeat password'/>
                 </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='text' name='firstname' placeholder='Firstname'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='text' name='lastname' placeholder='Lastname'/>
                </div>
            </div>
            <div class='input-block'>
                 <div>
                    <input type='text' name='city' placeholder='City'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='text' name='zip' placeholder='Zip'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input type='text' name='phonenumber' placeholder='Phonenumber'/>
                </div>
            </div>
            <div class='input-block'>
                <div>
                    <input id='input-email' type='text' name='email' placeholder='Email'/>
                </div>
            </div>
            <input class='btn-registration' type='submit' value='Register'>
        </form>
        <div class='registration-message'>$message</div>
    </div>
    
 </div>


";






?>

