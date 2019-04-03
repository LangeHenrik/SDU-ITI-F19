<style><?include("css/bootstrap.css");?></style>
<?include("./controllers/login.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<div class = "container form-signin">
    <br><br>
    <div class = "container">
        <form class = "form-signin" role = "form"
              action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
              ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control"
                   name = "username" placeholder = "username"
                   required autofocus></br>
            <input type = "password" class = "form-control"
                   name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                    name = "login">Login</button>
        </form>
        Click here to Signup <a href = "templates/signup_view.php">Signup.
    </div>
</div> <!-- login /container -->
</body>
</html>