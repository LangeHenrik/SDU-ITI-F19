<?php
if (isset($_POST['signup-submit'])){

    require 'databaseHandler.res.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $zipcode = $_POST['zip'];
    $city = $_POST['city'];
    $telephone = $_POST['phone'];

    if (empty($username) ||
        empty($email) ||
        empty($password) ||
        empty($passwordRepeat) ||
        empty($firstname) ||
        empty($lastname) ||
        empty($zipcode) ||
        empty($city) ||
        empty($telephone)) {

        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!filter_var(@$email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $username . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../signup.php?error=invalidfirstname&uid=" . $username . "&mail=" . $email . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../signup.php?error=invalidlastname&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[0-9]{4}$/", $zipcode)) {
        header("Location: ../signup.php?error=invalidzipcode&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&city=" . $city . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z]*$/", $city)) {
        header("Location: ../signup.php?error=invalidcity&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&phone=" . $telephone);
        exit();
    }
    else if (!preg_match("/^[0-9]{8}$/", $telephone)) {
        header("Location: ../signup.php?error=invalidphone&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city);
        exit();
    }
    else {

        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare(@$statement, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usernametaken&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
                exit();
            }
            else {

                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, firstNameUsers, lastNameUsers, zipCodeUsers, cityUsers, phoneUsers) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $statement = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare(@$statement, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($statement, "sssssisi", $username, $email, $hashedPwd, $firstname, $lastname, $zipcode, $city, $telephone);
                    mysqli_stmt_execute($statement);
                    //header("Location: ../index.php?signup=success");
                    $sqllogin = "SELECT idUsers FROM users WHERE uidUsers=$username;";

                    session_start();

                    $_SESSION['userId'] = $sqllogin;
                    $_SESSION['userUid'] = $username;
                    header("Location: ../index.php?login=success");
                }
            }
        }

    }
    mysqli_stmt_close($statement);
    mysqli_close($connection);

}

else {
    header("Location: ../signup.php");
    exit();
}