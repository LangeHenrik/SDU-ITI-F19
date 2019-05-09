<?php
require "../app/models/RegisterModel.php";

class SignupService extends Database
{
    public function registerUser($username, $email, $password, $passwordRepeat, $firstname, $lastname, $zipcode, $city, $telephone)
    {
        if (empty($username) ||
            empty($email) ||
            empty($password) ||
            empty($passwordRepeat) ||
            empty($firstname) ||
            empty($lastname) ||
            empty($zipcode) ||
            empty($city) ||
            empty($telephone)) {


            $_SESSION['error'] = "emptyfields";
            //header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!filter_var(@$email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "invalidmail";
            //header("Location: ../signup.php?error=invalidmail&uid=" . $username . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $_SESSION['error'] = "invaliduid";
            //header("Location: ../signup.php?error=invaliduid&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if ($password !== $passwordRepeat) {
            $_SESSION['error'] = "passwordcheck";
            //header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
            $_SESSION['error'] = "invalidfirstname";
            //header("Location: ../signup.php?error=invalidfirstname&uid=" . $username . "&mail=" . $email . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
            $_SESSION['error'] = "invalidlastname";
            //header("Location: ../signup.php?error=invalidlastname&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[0-9]{4}$/", $zipcode)) {
            $_SESSION['error'] = "invalidzipcode";
            //header("Location: ../signup.php?error=invalidzipcode&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&city=" . $city . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[a-zA-Z]*$/", $city)) {
            $_SESSION['error'] = "invalidcity";
            //header("Location: ../signup.php?error=invalidcity&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&phone=" . $telephone);
            return false;
        } else if (!preg_match("/^[0-9]{8}$/", $telephone)) {
            $_SESSION['error'] = "invalidphone";
            //header("Location: ../signup.php?error=invalidphone&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city);
            return false;
        } else {
            $_SESSION['error'] = null;

            $sql = "SELECT uidUsers FROM users WHERE uidUsers = :username";
            $statement = $this->conn->prepare($sql);

            $statement->bindParam(":username", $username);
            $statement->execute();
            if($statement->fetch(PDO::FETCH_ASSOC)) {
                $uidTaken = true;
                if ($uidTaken) {
                    $uid_error = "Username is already taken";
                    die($uid_error);
                    return false;
                }
            } else {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, firstNameUsers, lastNameUsers, zipCodeUsers, cityUsers, phoneUsers) VALUES (:username, :email, :password, :firstname, :lastname, :zipcode, :city, :phone)";
                $statement = $this->conn->prepare($sql);
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                //mysqli_stmt_bind_param($statement, "sssssisi", $username, $email, $hashedPwd, $firstname, $lastname, $zipcode, $city, $telephone);

                $statement->bindParam(":username", $username);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":password", $hashedPwd);
                $statement->bindParam(":firstname", $firstname);
                $statement->bindParam(":lastname", $lastname);
                $statement->bindParam(":zipcode", $zipcode);
                $statement->bindParam(":city", $city);
                $statement->bindParam(":phone", $telephone);

                $statement->execute();

                $id = $this->conn->lastInsertId();

                $_SESSION["userUid"] = $username;
                $_SESSION["userId"] = $id;
                return true;
            }
        }
    }
}