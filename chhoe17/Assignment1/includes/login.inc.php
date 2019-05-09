<?php

//First start a session
session_start();

//Then require the database connection
require_once 'db_config.php';

//check if the user has clicked the login button
if (isset($_POST['submit'])) {

    // then get the data from the login form
    $name = $_POST['name'];
    $password = $_POST['password'];

    //Error handlers
    //Error handlers are important to avoid any mistakes the user might have made when filling out the form!
    //Check if inputs are empty
    if (empty($name) || empty($password)) {
        header("Location: ../index.php?login=empty");
        exit();
    }    
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name=:name");  // Changed $db to $conn to use the connection from DBH.INC.PHP
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

    if (!$stmt->execute()) {   // Added the ! to say "if this doesn't work, redirect to error"
        header("location: ../index.php?login=error");
        exit();
    } else { 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //de-hashing the password
            $hashedpasswordCheck = password_verify($password, $row['user_password']);
            if ($hashedpasswordCheck == false) {
                header("location: ../index.php?login=error");
                exit();
            } else if ($hashedpasswordCheck == true) {
                //Log in the user here
                $_SESSION['u_id'] = $row['user_id'];
                $_SESSION['u_name'] = $row['user_name'];
                header("location: ../index.php?login=success");
                exit();
            }
        } else {
        header("location: ../index.php?login=error");
        exit();
        }     
    }  
}


?>
