<?php
class User extends Database {

    function setUsername($username) {
        this::$username = $username;
    }

    public function checkInput(){
        $conn = parent::getConn();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter a username.";
            } else {
                $sql = "SELECT id FROM users WHERE username = :param_username";
                $stmt = $conn->prepare($sql);
                $param_username = trim($_POST["username"]);
                $stmt->bindParam(':param_username', $param_username);

                if ($stmt->execute()) {
                    echo 'test';
                        $stmt->fetchAll();
                        print_r($stmt);
                        $nr_rows = $stmt->rowCount();
                        $username_err = $nr_rows;
                        if ($stmt->rowCount() === 1) {
                            $username_err = "This username is already taken.";
                        } else {
                            $username = trim($_POST["username"]);
                        }
                }
            }

            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter a password.";
            } elseif (strlen(trim($_POST["password"])) < 6) {
                $password_err = "Password must have atleast 6 characters.";
            } else {
                $password = trim($_POST["password"]);
            }
            if (empty(trim($_POST["confirm_password"]))) {
                $confirm_password_err = "Please confirm password.";
            } else {
                $confirm_password = trim($_POST["confirm_password"]);
                if (empty($password_err) && ($password != $confirm_password)) {
                    $confirm_password_err = "Password did not match.";
                }
            }
            if (empty(trim($_POST["firstname"]))) {
                $firstname_err = "Please enter a first name.";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["firstname"])) {
                $firstname_err = "Only letters and whitespace allowed";
            } else {
                $firstname = trim($_POST["firstname"]);
            }
            if (empty(trim($_POST["lastname"]))) {
                $lastname_err = "Please enter a last name.";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["lastname"])) {
                $lastname_err = "Only letters and whitespace allowed";
            } else {
                $lastname = trim($_POST["lastname"]);
            }
            if (empty(trim($_POST["zipcode"]))) {
                $zipcode_err = "Please enter a zip code.";
            } elseif (!preg_match("#[0-9]{4}#", $_POST["zipcode"])) {
                $zipcode_err = "Only numbers";
            } elseif (strlen($_POST["zipcode"]) > 4) {
                $zipcode_err = "Max lenght is 4";
            } else {
                $zipcode = trim($_POST["zipcode"]);
            }
            if (empty(trim($_POST["city"]))) {
                $city_err = "Please enter a city.";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["city"])) {
                $city_err = "Only letters and whitespace allowed";
            } else {
                $city = trim($_POST["city"]);
            }
            if (empty(trim($_POST["email"]))) {
                $email_err = "Please enter an email.";
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $email_err = "Not a valid email";
            } else {
                $email = trim($_POST["email"]);
            }
            if (empty(trim($_POST["phonenumber"]))) {
                $phonenumber_err = "Please enter a phone number.";
            } elseif (!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $_POST["phonenumber"])) {
                $phonenumber_err = "Only numbers allowed";
            } elseif (strlen($_POST["phonenumber"]) > 8) {
                $phonenumber_err = "Max length is 8";
            } else {
                $phonenumber = trim($_POST["phonenumber"]);
            }
        }
    }

    public function sendInput($username, $password, $firstname, $lastname, $zipcode, $city, $email, $phonenumber){
            if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($zipcode_err) && empty($city_err) && empty($email_err) && empty($phonenumber_err)) {

                $sql = "INSERT INTO users (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $conn = parent::getConn();

                if ($stmt = $conn->prepare($sql)) {

                    //mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_zipcode, $param_city, $param_email, $param_phonenumber);

                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    $param_firstname = $firstname;
                    $param_lastname = $lastname;
                    $param_zipcode = $zipcode;
                    $param_city = $city;
                    $param_email = $email;
                    $param_phonenumber = $phonenumber;

                    $stmt->bindParam($param_username, $param_password, $param_firstname, $param_lastname, $param_zipcode, $param_city, $param_email, $param_phonenumber);

                    if ($stmt->execute()) {
                        // Redirect to login page
                        header("location: index");
                    } else {
                        echo "Something went wrong. Please try again later.";
                    }
                }
            }
            parent::__destruct();
    }
}
