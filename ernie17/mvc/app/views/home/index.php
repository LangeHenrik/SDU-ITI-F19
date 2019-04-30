<?php include '../app/views/partials/head.php'; ?>

<h2 class="title">Welcome to an awesome picture place!</h2>
<div class="login">
    <?php
        if(isset($_SESSION["loginResult"])) {
            echo "<p class='error-response'>" . $_SESSION["loginResult"] . "</p>";
        }
    ?>
    <form class="form-login" method="post" action="home/login">
        <fieldset>
            <legend>Login</legend>
            <input type="text" name="login-username" id="login-username" placeholder="Username"><br><br>
            <input type="password" name="login-password" id="login-password" placeholder="Password"><br><br>
            <button name="btn-login">Login</button>
        </fieldset>
    </form>
</div>
<div class="register">
    <?php
        if(isset($_SESSION["registerResult"])) {
            echo "<p class='error-response'>" . $_SESSION["registerResult"] . "</p>";
        }
    ?>
    <p style="display: none" class="error-response" id="js-response" style="color: #F00">test</p>
    <form class="form-register" method="post" onsubmit="return checkRegisterFields()" action=home/register>
        <fieldset>
            <legend>Register</legend>
            <p>Username</p>
            <input type="text" name="register-username" id="register-username" required><br><br>
            <p>Password</p>
            <input type="password" name="register-password" id="register-password" required><br><br>
            <p>Repeat Password</p>
            <input type="password" name="register-password-repeat" id="register-password-repeat" required><br><br>
            <p>Firstname</p>
            <input type="text" name="register-firstname" id="register-firstname" required><br><br>
            <p>Lastname</p>
            <input type="text" name="register-lastname" id="register-lastname" required><br><br>
            <p>Zip</p>
            <input type="text" name="register-zip" id="register-zip" required><br><br>
            <p>City</p>
            <input type="text" name="register-city" id="register-city" required><br><br>
            <p>Email</p>
            <input type="text" name="register-email" id="register-email" required><br><br>
            <p>Phone number</p>
            <input type="text" name="register-phone" id="register-phone" required><br><br>
            <button name="btn-register">Register</button>
        </fieldset>
    </form>
</div>

<?php include '../app/views/partials/foot.php'; ?>
