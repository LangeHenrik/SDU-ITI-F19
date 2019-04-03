<style><?include("css/bootstrap.css");?></style>
<?include("../controllers/signup.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
</head>
<body>
<div class="container" id="main-content">
    <br>
    <h2>Sign up below</h2>
    <br>
<div class = "container form-signin">
</div> <!-- login /container -->
    <div class = "container">
        <form class = "form-signin" role = "form"
              name="signupform" enctype="multipart/form-data" method = "post">

            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>

            <input type = "text" class = "form-control"
                   name = "username" placeholder = "username"
                   required autofocus></br>

            <input type = "password" class = "form-control"
                   name = "password" placeholder = "password" required></br>

            <input type = "password" class = "form-control"
                   name = "repeat-password" placeholder = "repeat password" required></br>

            <input type = "text" class = "form-control"
                   name = "firstname" placeholder = "first name" required></br>

            <input type = "text" class = "form-control"
                   name = "lastname" placeholder = "last name" required></br>

            <input type = "text" class = "form-control"
                   name = "zip" placeholder = "ZIP code"></br>

            <input type = "text" class = "form-control"
                   name = "city" placeholder = "City"></br>

            <input type = "text" class = "form-control"
                   name = "email" placeholder = "Email" required></br>

            <input type = "text" class = "form-control"
                   name = "phonenumber" placeholder = "Phone number" required></br>

            <input type='file' name='file'>

            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                    name = "signup">Sign up</button>
        </form>
    </div>
</div>
</body>
</html>