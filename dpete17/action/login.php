<?php
    session_start();

    $u_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $u_password = $_POST['password'];

    $u_username = htmlentities($u_username);
    $u_password = htmlentities($u_password);

    if(empty($u_username) || empty($u_password)) {
        $_SESSION['MESSAGE'] = 'Atleast one field is empty!';
        header('Location: ../index.php');
    } else {
        $sql = 'SELECT id, password FROM account WHERE LOWER(username) = LOWER(:username);';

        include('pdo.php');

        try {
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':username', $u_username);

            $stmt -> execute();

            $result = $stmt -> fetchAll();

            if(count($result) > 0 && password_verify($u_password, $result[0]['password'])) {
                $_SESSION['ID'] = $result[0]['id'];
                header('Location: ../dashboard/account.php');
            } else {
                $_SESSION['MESSAGE'] = 'Wrong Username or Password.';
                header('Location: ../index.php');
            }
        } catch (PDOException $e) {
            $_SESSION['MESSAGE'] = 'Error: ' . $e -> getMessage();
        }
    }

    $hashed = password_hash($u_password, PASSWORD_DEFAULT);
    $_SESSION['MESSAGE'] = $hashed;
?>