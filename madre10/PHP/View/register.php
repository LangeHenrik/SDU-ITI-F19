<?php
require_once(__DIR__ . '/../Model/userDAO.php');


if (isset($_SESSION['user_id'])) {
    header("Location: /");
}
require_once(__DIR__ . '/../Model/userDAO.php');
$message = '';

if(isset($_POST['email'])) {
    $all_fields_completed = true;
    $any_fields_completed = false;
    $fields = ['username', 'email', 'firstname', 'lastname', 'zip', 'city', 'phone', 'password', 'password_repeat'];
//Perhaps additional checks here...
    $user = [];
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $all_fields_completed = false;
        } else {
            $any_fields_completed = true;
        }
        //Sanitize...
        $user[$field] = htmlentities($_POST[$field]);
    }

    if ($all_fields_completed && $_POST['password'] !== $_POST['password_repeat']) {
        $message = "Password does not match!";
        $all_fields_completed = false;
    }

    if ($all_fields_completed):
        $response = createUser($user);
        if ($response) {
            $message = "User successfully created. You can now login.";
        } else {
            $message = "Oh lord, something went wrong";
        }

    elseif ($any_fields_completed && $message == ''):
        $message = "You have to fill out all the fields";
    endif;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/CSS/main.css">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/CSS/register.css">
</head>
<body>
<?php include(__DIR__ . '/Components/NavigationBar.php'); ?>
<?php if (!empty($message)): ?>
    <div class="alert_message"><?= $message ?></div>
<?php endif; ?>

<div class="register_wrapper">
    <div class="register_box">
        <h1 class="register_title">Register</h1>
        <form class="form" action="register" method="POST">
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

</body>
</html>