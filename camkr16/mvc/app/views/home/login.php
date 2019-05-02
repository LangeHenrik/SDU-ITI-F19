<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturest</title>
    <link href="/camkr16/mvc/public/style/login.css" type="text/css" rel="stylesheet">

</head>
<body>
<h1 class="headertitle">Picturest</h1>

<form id="loginPage" style="text-align: center" action="login" method="post">
    <div>
        <input class="input" type="text" placeholder="Username" id="usernameinput" name="username">
        <?php if ($viewbag["username_error"]) {
            echo "There was an error " . $viewbag["username_error"];
        } ?>
    </div>
    <div>
        <input class="input" type="password" placeholder="Password" id="userpasswordinput" name="password">
        <?php if ($viewbag["password_error"]) {
            echo "There was an error " . $viewbag["password_error"];
        } ?>
    </div>
    <div>
        <button class="button" type="submit">Take a look</button>
    </div>
    <div>
        <a href="/camkr16/mvc/public/authentication/signup" class="button">Create account</a>
    </div>

    <div class="joke">
        <h3>Daily Joke Service:</h3>
        <p>
            <?= $viewbag["joke"]; ?>
        </p>
    </div>
</form>

</body>
</html>