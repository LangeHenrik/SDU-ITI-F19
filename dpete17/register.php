<?php

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    if(isset($user_email) && isset($user_password)) {
        // REGEX JAVASCRIPT
        
        filter_input(INPUT_GET, $user_email, FILTER_VALIDATE_EMAIL);
        htmlentities($user_email);

        include('pdo.php');
        
        $sql = 'INSERT INTO account(email, password) VALUES (:email, :password);';
        
        try {
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':email', $user_email);
            $stmt -> bindParam(':password', password_hash($user_password, PASSWORD_DEFAULT));

            echo $stmt -> execute();

            header('Location: index.php');
        } catch (PDOException $e) {
            echo "ERROR: " . $e -> getMessage();
        }
    }

?>