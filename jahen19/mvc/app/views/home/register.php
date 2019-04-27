<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no">
</head>
<body>
    <main>
            <form name="registration" id="registrationform" method="post" action="/jahen19/mvc/public/api/register">
                <input type="text" name="username" placeholder="Username..." required>
                <br>
                <input type="password" name="password" placeholder="Password..." required>
                <br>
                <input type="password" name="password-repeat" placeholder="Repeat Password..." required>
                <!-- TODO: check password repeat field via javascript -->
                <br>
                <input type="text" name="city" placeholder="City...">
                <br>
                <input type="text" name="email" placeholder="Email...">
                <br>
                <input id="signup-button" name="signup" type="submit" value="Sign up">
            </form>

    </main>
</body>
</html>
