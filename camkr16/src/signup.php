<?php
require "connection.php";

$required_error = " is required";
$username_error = "";
$password_error = "";
$repeatPassword_error = "";
$firstname_error = "";
$lastname_error = "";
$zip_error = "";
$city_error = "";
$email_error = "";
$phone_error = "";

$has_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $zip = $_POST["zip"];
    $city = $_POST["city"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if (empty($username)) {
        $has_error = true;
        $username_error = "Username" . $required_error;
    }
    if (empty($password)) {
        $has_error = true;
        $password_error = "Password" . $required_error;
    }
    if (empty($repeatPassword)) {
        $has_error = true;
        $repeatPassword_error = "Repeat password" . $required_error;
    }
    if ($password != $repeatPassword) {
        $has_error = true;
        $repeatPassword_error = "Passwords are not the same";
    }
    if (empty($firstname)) {
        $has_error = true;
        $firstname_error = "Firstname" . $required_error;
    }
    if (empty($lastname)) {
        $has_error = true;
        $lastname_error = "Lastname" . $required_error;
    }
    if (empty($zip)) {
        $has_error = true;
        $zip_error = "Zip" . $required_error;
    }
    if (empty($city)) {
        $has_error = true;
        $city_error = "City" .$required_error;
    }
    if (empty($email)) {
        $has_error = true;
        $email_error = "Email". $required_error;
    }
    if (empty($phone)) {
        $has_error = true;
        $phone_error = "Phone" . $required_error;
    }

    if (!$has_error) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        /**
         * @var PDO $conn
         */
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $username_error = "Username already exist";
            $has_error = true;
        }
        if (!$has_error) {
            $stmt = $conn->prepare("INSERT INTO user(username, password, firstname, lastname, zip, city, email, phone) 
VALUES(:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":zip", $zip);
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone", $phone);

            $stmt->execute();

            $id = $conn->lastInsertId();

            session_start();
            $_SESSION["id"] = $id;
            header("Location: /index.php");
        }

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturest</title>
    <link href="style/login.css" type="text/css" rel="stylesheet">

</head>
<body>
<h1 class="headertitle">Picturest</h1>

<form id="loginPage" style="text-align: center" action="signup.php" method="post">
    <div>
        <input class="input" type="text" placeholder="Username" id="usernameInput" name="username">
        <?php
        if ($username_error) {
            echo '<span class="error">' . $username_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="password" placeholder="Password" id="userPasswordInput" name="password">
        <?php
        if ($password_error) {
            echo '<span class="error">' . $password_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="password" placeholder="Repeat password" id="repeatPasswordInput"
               name="repeatPassword">
        <?php
        if ($repeatPassword_error) {
            echo '<span class="error">' . $repeatPassword_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Firstname" id="firstnameinput" name="firstname">
        <?php
        if ($firstname_error) {
            echo '<span class="error">' . $firstname_error . "</span>";
        }
        ?>
        <input class="input" type="text" placeholder="Lastname" id="lastnameinput" name="lastname">
        <?php
        if ($lastname_error) {
            echo '<span class="error">' . $lastname_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Zip" id="zipinput" name="zip">
        <?php
        if ($zip_error) {
            echo '<span class="error">' . $zip_error . "</span>";
        }
        ?>
        <input class="input" type="text" placeholder="City" id="cityinput" name="city">
        <?php
        if ($city_error) {
            echo '<span class="error">' . $city_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="E-mail" id="emailinput" name="email">
        <?php
        if ($email_error) {
            echo '<span class="error">' . $email_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Phone" id="phoneinput" name="phone">
        <?php
        if ($phone_error) {
            echo '<span class="error">' . $phone_error . "</span>";
        }
        ?>
    </div>
    <div>
        <button class="button" type="submit">Create account</button>
    </div>
    <div>
        <a href="login.php" class="button">Already have an account?</a>
    </div>
</form>

</body>
</html>