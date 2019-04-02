<?php
session_start();
if( isset($_SESSION['user_id']) ){
    header("Location: /");
}
require 'database.php';
if(!empty($_POST['username']) && !empty($_POST['password'])):

    $records = $conn->prepare('SELECT id,username,password FROM users WHERE username = :username');
    $records->bindParam(':username', $_POST['username']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
    if($results!=null && ($_POST['password'] == $results['password'] )){
        $_SESSION['user_id'] = $results['id'];
        header("Location: /");
    } else {
        $message = 'Sorry, those credentials do not match';
    }
endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Below</title>
    <link rel="stylesheet" type="text/css" href="General.css">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>

<div id="navbar"></div>

<?php if(!empty($message)): ?>
    <div class="alert_message"><?= $message ?></div>
<?php endif; ?>




<div class="register_wrapper">
    <div class="register_box">
        <h1 class="register_title">Login</h1>
        <form class="form" action="login.php" method="POST">
            <div class="form__group">
                <input type="text" placeholder="Username" class="form__input" name="username"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Password" class="form__input" name="password"/>
            </div>

            <button class="btn" type="submit">Login</button>
            <br/>
            <center>or <a href="register.php">register here</a></center>
        </form>

    </div>
</div>



<script src="navbar.js"></script>
</body>
</html>