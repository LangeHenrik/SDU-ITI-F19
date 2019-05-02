<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Account Login</title>
    <link href="/mifor16/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">

</head>
<body>

<form action="/mifor16/mvc/public/Login/login" method="post">
    <div class="box">
        <fieldset>

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" value="Submit">Login</button>
        <?php if (isset($viewbag["error_msg"])) {
            echo '<br>';
            echo $viewbag["error_msg"];
        } ?>
    </div>


</form>

<div class="box">
    <a href="/mifor16/mvc/public/Register">Register User</a>
</div>


</body>


</html>