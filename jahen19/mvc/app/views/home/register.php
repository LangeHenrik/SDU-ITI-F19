<!--DOCTYPE_HTML-->
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
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
