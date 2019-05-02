<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/mmare15/mvc/public/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">

        body{ font: 14px sans-serif; background-image: url("../../10.jpg")}

        .topleft {
            position: absolute;
            top: 8px;
            left: 16px;
            font-size: 18px;
            color: aliceblue;
        }


    </style>
</head>
<body>
    <h1 class="topleft">Login</h1>
    <div class="loginbox">


        <!-- <p>Please fill in your credentials to login.</p> -->

        <div class ="loginbox">
            <form action="/mmare15/mvc/public/Login/login" method="post">
            <!-- <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
                <img src="../../images/avatar.png" class="avatar">


                <div class=" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <p>Username</p>
                    <input type="text" placeholder="Enter Username" name="username" class=""  value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
</div>


<div class="  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <p>Password</p>
    <input type="password" name="password" placeholder="Enter Password" class="form-control" > <!-- before also class"form-control"-->
    <span class="help-block"><?php echo $password_err; ?></span>
</div>


<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Login">
</div>

<p>Don't have an account? <a href="/mmare15/mvc/public/Register">Sign up now</a>.</p>

</form>
</div>


</div>
</body>
</html>
