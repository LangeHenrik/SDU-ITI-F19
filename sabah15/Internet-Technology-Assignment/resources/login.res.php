<?php

if (isset($_POST['login-submit'])) {

    require 'databaseHandler.res.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {

            mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    $_SESSION['mail'] = $row['emailUsers'];
                    $_SESSION['firstname'] = $row['firstNameUsers'];
                    $_SESSION['lastname'] = $row['lastNameUsers'];
                    $_SESSION['zip'] = $row['zipCodeUsers'];
                    $_SESSION['city'] = $row['cityUsers'];
                    $_SESSION['phone'] = $row['phoneUsers'];


                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

}
else {
    header("Location: ../index.php");
    exit();
}