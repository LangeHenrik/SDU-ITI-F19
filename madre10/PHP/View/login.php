<?php

require_once(__DIR__ . '/../Model/userDAO.php');
if (isset($_SESSION['user_id'])) {
    header("Location: /madre10/");
}

if (!empty($_POST['username']) && !empty($_POST['password'])):

    $user = getUserByUsername($_POST['username']);
    $message = '';
    if ($user != null && (password_verify($_POST['password'], $user['password']))) {
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: /madre10/");
    } else {
        $message = 'Sorry, those credentials do not match';
    }
endif;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Below</title>
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/main.css">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/register.css">
</head>
<body>

<?php include(__DIR__ . '/Components/NavigationBar.php'); ?>

<?php if (!empty($message)): ?>
    <div class="alert_message"><?= $message ?></div>
<?php endif; ?>


<div class="register_wrapper">
    <div class="register_box">
        <h1 class="register_title">Login</h1>
        <form class="form" action="login" method="POST">
            <div class="form__group">
                <input type="text" placeholder="Username" class="form__input" name="username"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Password" class="form__input" name="password"/>
            </div>

            <button class="btn" type="submit">Login</button>
            <br/>
            <center>or <a href="register">register here</a></center>
        </form>

    </div>
</div>


<script src="navbar.js"></script>
</body>
</html>
