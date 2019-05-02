<? include '../app/views/partials/menu.php'; ?>
<style><?include("css/bootstrap.css");?></style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Login</title>
</head>
<body>
<div class = "container form-signin">
    <br><br>
    <div class = "container">
        <form class = "form-signin" role = "form"
              action = "/longu17/mvc/public/home/index" method = "post">
            <h4 class = "form-signin-heading"></h4>
            <input type = "text" class = "form-control"
                   name = "username" placeholder = "username"
                   required autofocus></br>
            <input type = "password" class = "form-control"
                   name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                    name = "login">Login</button>
        </form>
        Click here to Signup <a href = "signup">Signup.
    </div>
</div>
</body>
</html>
