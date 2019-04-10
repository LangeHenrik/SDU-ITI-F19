<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='../../app/css/loginform.css'>";

echo "<form  method='post' class='login-form' action='login'>
        <div class='input-block'>
            <label >Username</label>
            <input type='text' name='username'>
        </div>
        <div class='input-block'>
            <label >Password</label>
            <input type='password' name='password'>
        </div>
        <input type='submit'/>
       </form>";
?>