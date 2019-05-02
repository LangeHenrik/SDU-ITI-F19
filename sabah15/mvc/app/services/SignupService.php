<?php


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

            header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!filter_var(@$email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=" . $username . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invaliduid&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if ($password !== $passwordRepeat) {
            header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
            header("Location: ../signup.php?error=invalidfirstname&uid=" . $username . "&mail=" . $email . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
            header("Location: ../signup.php?error=invalidlastname&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&zip=" . $zipcode . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[0-9]{4}$/", $zipcode)) {
            header("Location: ../signup.php?error=invalidzipcode&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&city=" . $city . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[a-zA-Z]*$/", $city)) {
            header("Location: ../signup.php?error=invalidcity&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&phone=" . $telephone);
            exit();
        } else if (!preg_match("/^[0-9]{8}$/", $telephone)) {
            header("Location: ../signup.php?error=invalidphone&uid=" . $username . "&mail=" . $email . "&firstname=" . $firstname . "&lastname=" . $lastname . "&zip=" . $zipcode . "&city=" . $city);
            exit();
        } else {

            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $statement = $this->conn->prepare($sql);

            $statement->bindParam("uid", $username);
            $statement->execute();
            $uidTaken = $statement->fetch(PDO::FETCH_ASSOC);
            if ($uidTaken) {
                $uid_error = "Username is already taken";
                die($uid_error);
                return false;
            } else {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, firstNameUsers, lastNameUsers, zipCodeUsers, cityUsers, phoneUsers) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $statement = $this->conn->prepare($sql);
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                //mysqli_stmt_bind_param($statement, "sssssisi", $username, $email, $hashedPwd, $firstname, $lastname, $zipcode, $city, $telephone);

                $statement->bindParam("uid", $username);
                $statement->bindParam("mail", $email);
                $statement->bindParam("pwd", $hashedPwd);
                $statement->bindParam("firstname", $firstname);
                $statement->bindParam("lastname", $lastname);
                $statement->bindParam("zip", $zipcode);
                $statement->bindParam("city", $city);
                $statement->bindParam("phone", $telephone);

                $statement->execute();
                $id = $this->conn->lastInsertedId();
                $_SESSION["id"] = $id;
                return true;
            }
        }
    }
}