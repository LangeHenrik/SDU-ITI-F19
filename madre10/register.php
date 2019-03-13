<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /");
}
require 'database.php';
$message = '';

$all_fields_completed = true;
$any_fields_completed = false;
$fields = ['username', 'email', 'firstname', 'lastname', 'zip', 'city', 'phone', 'password', 'password_repeat'];
//Perhaps additional checks here...
foreach ($fields as $field) {
    if (empty($_POST[$field])) {
        $all_fields_completed = false;
    } else {
        $any_fields_completed = true;
    }
}

if ($all_fields_completed && $_POST['password'] !== $_POST['password_repeat']){
    $message = "Password does not match!";
    $all_fields_completed = false;
}

if ($all_fields_completed):
    // Enter the new user in the database
    $sql = "INSERT INTO users(username, password, firstname, lastname, zip, city, email, phone) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)";
    $stmt = $conn->prepare($sql);
    foreach ($fields as $field) {
        if($field !== 'password_repeat') {
            $stmt->bindParam(''.$field , $_POST[$field]);
        }
    }



    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);
    if ($stmt->execute()):
        $message = 'Successfully created new user. <a href="login.php"> Log in here.</a>';
    else:
        $message = 'Sorry there must have been an issue creating your account';
    endif;
elseif ($any_fields_completed && $message==''):
    $message = "You have to fill out all the fields";

endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="General.css">
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
<div id="navbar"></div>
<?php if (!empty($message)): ?>
    <div class="alert_message"><?= $message ?></div>
<?php endif; ?>

<div class="register_wrapper">
    <div class="register_box">
        <h1 class="register_title">Register</h1>
        <form class="form" action="register.php" method="POST">
            <div class="form__group">
                <input type="text" placeholder="Username" class="form__input" name="username"/>
            </div>

            <div class="form__group">
                <input type="email" placeholder="Email" class="form__input" name="email"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="First name" class="form__input" name="firstname"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Last name" class="form__input" name="lastname"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Zip code" class="form__input" name="zip"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="City" class="form__input" name="city"/>
            </div>

            <div class="form__group">
                <input type="text" placeholder="Phone number" class="form__input" name="phone"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Password" class="form__input" name="password"/>
            </div>

            <div class="form__group">
                <input type="password" placeholder="Repeat Password" class="form__input" name="password_repeat"/>
            </div>

            <button class="btn" type="submit">Register</button>
        </form>
    </div>
</div>




<script src="navbar.js"></script>
</body>
</html>