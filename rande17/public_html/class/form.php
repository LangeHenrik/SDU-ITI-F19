<?php
class forms{

    function login(){
        if(isset($_COOKIE['user'])){
            $user = $_COOKIE['user'];
        }else{
            $user = "";
        }
        echo "<form id='form' action='login.php' method='POST'>";
        echo "<h1> LOGIN </h1>";
        echo "<input type='text' class='text' placeholder='Username' name='username' value='$user' >";
        echo "<input type='password' class='text' placeholder='Password' name='password'>";
        echo "<input type='submit' class='text' value='Login &#8605;' id='submit'>";
        echo "</form>";
        echo "<a class='link' href='signup.php'>Opret bruger</a> ";
    }

    function signup(){
        ?>
        <form onsubmit='return checkForm()' id='form' action='signup.php' method='POST'>
            <h1> Signup </h1>
            <input type='text' class='text' placeholder='Firstname' name='fname' value='<?=$_POST['fname']?>'>
            <input type='text' class='text' placeholder='Lastname' name='lname' value='<?=$_POST['lname']?>'>
            <input type='text' class='text' placeholder='ZIP code' name='zip' value='<?=$_POST['zip']?>'>
            <input type='text' class='text' placeholder='City' name='city' value='<?=$_POST['city']?>'>
            <input type='text' class='text' placeholder='Phone' name='phone' value='<?=$_POST['phone']?>'>
            <input type='text' class='text' placeholder='Username' name='username' value='<?=$_POST['username']?>'>
            <input type='text' class='text' placeholder='E-mail' name='mail' value='<?=$_POST['mail']?>'>
            <input id='password'type='password' class='text' placeholder='Password' name='password'>
            <input id='password2'type='password' class='text' placeholder='Repeat Password' name='password2'>
            <input type='submit' class='text' value='Opret Bruger' id='submit'>
        </form>
        <?php
    }

}
?>
