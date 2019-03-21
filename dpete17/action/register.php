<?php
    
    session_start();

    # u stands for user
    $u_username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $u_password =  filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $u_repeat_password =  filter_input(INPUT_POST, "repeat_password", FILTER_SANITIZE_STRING);
    $u_firstname =  filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
    $u_lastname =  filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
    $u_zip =  filter_input(INPUT_POST, "zip", FILTER_SANITIZE_STRING);
    $u_city =  filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
    $u_email =  filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $u_phone =  filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);

    $u_username = htmlentities($u_username);
    $u_password = htmlentities($u_password);
    $u_repeat_password = htmlentities($u_repeat_password);
    $u_firstname = htmlentities($u_firstname);
    $u_lastname = htmlentities($u_lastname);
    $u_zip = htmlentities($u_zip);
    $u_city = htmlentities($u_city);
    $u_email = htmlentities($u_email);
    $u_phone = htmlentities($u_phone);

    if(empty($u_username) || empty($u_password) || empty($u_firstname) ||
    empty($u_lastname) || empty($u_zip) || empty($u_city) ||
    empty($u_email) || empty($u_phone)) {
        $_SESSION['MESSAGE'] = 'Atleast one field is empty!';
    } else {
        $hashed = password_hash($u_password, PASSWORD_DEFAULT);

        include('pdo.php');
        
        $sql = 'INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone);';
        
        try {
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':username', $u_username);
            $stmt -> bindParam(':password', $hashed);
            $stmt -> bindParam(':firstname', $u_firstname);
            $stmt -> bindParam(':lastname', $u_lastname);
            $stmt -> bindParam(':zip', $u_zip);
            $stmt -> bindParam(':city', $u_city);
            $stmt -> bindParam(':email', $u_email);
            $stmt -> bindParam(':phone', $u_phone);

            if($stmt -> execute()) {
                $_SESSION['MESSAGE'] = $u_username . ' is now registered!';
            } else {
                $_SESSION['MESSAGE'] = 'Something went wrong.. Try again.';
            }
        } catch (PDOException $e) {
            $_SESSION['MESSAGE'] = 'Error: ' . $e -> getMessage();
        }
    }

    header('Location: ../index.php');

?>