<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="initial-scale=1.2, maximum-scale=1.5, width=device-width, user-scalable=no">
    <style>
     input {
         margin: 5px;
     }
    </style>
    <script>
     function checkPassword() {
         var form = document.getElementById("registrationform");
         /* var username = document.getElementById("username");*/
         var password = document.getElementById("password");
         var passwordrepeat = document.getElementById("passwordrepeat");
         /* var city = document.getElementById("city");
          * var email = document.getElementById("email");*/

         if (password.value != passwordrepeat.value) {
             passwordrepeat.setCustomValidity("Passwords don't match");
             return false;
         } else {
             passwordrepeat.setCustomValidity("");
             return true
         }
     }
    </script>
</head>
<body>
    <h1>Register a new account</h1>
    <p>
        Username may only contain letters A-Z (upper and lowercase) and digits.
        <br>
        Please choose a <a href="https://www.xkcd.com/936/">secure password</a>.
        <br>
        City may only contain letters A-Z.
        <br>
        Please enter a valid email address.
    </p>
    <main>
        <form name="registration" id="registrationform" method="post" action="/jahen19/mvc/public/api/register" onsubmit="return checkPassword()">
            <input id="username" type="text" name="username" placeholder="Username..." required pattern="^[a-zA-Z0-9]*$">
                <br>
                <input id="password" type="password" name="password" placeholder="Password..." required>
                <br>
                <input id="passwordrepeat" type="password" name="password-repeat" placeholder="Repeat Password..." required onblur="checkPassword()">
                <br>
                <input id="city" type="text" name="city" placeholder="City..." pattern="^[a-zA-Z ]*$">
                <br>
                <input id="email" type="email" name="email" placeholder="Email...">
                <br>
                <br>
                <input id="signup-button" name="signup" type="submit" value="Sign up">
            </form>

    </main>
</body>
</html>
