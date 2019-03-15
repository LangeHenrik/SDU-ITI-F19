<?php

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    if(isset($user_email) && isset($user_password)) {
        // REGEX JAVASCRIPT
        
        filter_input(INPUT_GET, $user_email, FILTER_VALIDATE_EMAIL);
        htmlentities($user_email);

        include('pdo.php');
        
        $sql = 'SELECT id, email, password FROM account WHERE email = :email;';
        
        try {
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':email', $user_email);

            $stmt -> execute();

            $result = $stmt -> fetchAll();

            if(count($result) > 0 && password_verify($user_password, $result[0]['password'])) {
                if(session_status() == PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['ID'] = $result[0]['id'];
                }
            }

            //header('Location: index.php');
        } catch (PDOException $e) {
            echo "ERROR: " . $e -> getMessage();
        }
    }

?>