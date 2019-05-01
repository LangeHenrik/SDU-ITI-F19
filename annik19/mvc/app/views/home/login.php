<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/home.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <?php echo "<link rel='stylesheet' href='../css/login.css'>" ?>
    <title>Login</title>
</head>

<body>
<?php include '../app/views/partials/menu.php'; ?>
<div class="container">

    <div class="row">
        <div class="col-sm">
            <h2>Login</h2>
        </div>
        <div class="col-sm">
            <h2>Register</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm" style="color: red">
            <?php if (isset($viewbag['messages']) && !empty($viewbag['messages'])) {
                foreach ($viewbag['messages'] as $item) {
                    print $item . "<br>";
                }
                unset($viewbag);
            } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <form method="post" onsubmit="return validate()" action="loggedin">
                <div class="form-group">
                    <label>Username</label>
                    <input name="db_username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="db_password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-sm">
            <form action="register" method="post">
                <label>First name</label>
                <input name="fname" type="text" class="form-control">
                <label>Last name</label>
                <input name="last" type="text" class="form-control">
                <label>Create username</label>
                <input name="username" type="text" class="form-control">
                <label>Create password</label>
                <input name="password" type="password" class="form-control">
                <label>Repeat password</label>
                <input name="repeat_pwd" type="password" class="form-control">
                <label>City</label>
                <input name="city" type="text" class="form-control">
                <label>Zip</label>
                <input name="zip" type="number" class="form-control">
                <label>Email</label>
                <input name="email" type="email" class="form-control">
                <label>Phone number</label>
                <input name="phone" type="number" class="form-control">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="register">Register</button>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>