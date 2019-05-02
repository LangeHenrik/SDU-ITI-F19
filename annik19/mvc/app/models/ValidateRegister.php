<?php

class validateRegister
{
    public function register()
    {
        $fname = $lname = $username = $password = $repeat_pwd = $city = $zip = $email = $phone = "";
        $er_fname = $er_lname = $er_username = $er_password = $er_repeat = $er_city = $er_zip = $er_email = $er_phone = $er_dontmatch = "";
        $errors = array();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["fname"])) {
                $er_fname = "First Name required";
                array_push($errors, $er_fname);
            } else {
                //echo "test_input...";
                $fname = test_input($_POST["fname"]);
                if (!preg_match("/^([a-zA-Z])+$/", $fname)) {
                    //echo "regex check...";
                    $er_fname = "First name should be one word, use letters only";
                    array_push($errors, $er_fname);
                }
            }

            if (empty($_POST["password"])) {
                $er_password = "Password required";
                array_push($errors, $er_password);
            } elseif (empty($_POST["repeat_pwd"])) {
                $er_repeat = "Repeat the password";
                array_push($errors, $er_repeat);
            } elseif ($_POST["password"] != $_POST["repeat_pwd"]) {
                $er_dontmatch = "Passwords do not match";
                array_push($errors, $er_dontmatch);
            } else {
                $password = test_input($_POST["password"]);
                if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/", $password)) {
                    $er_password = "Password must contain at least one lowercase letter, at least
            one uppercase letter, at least one number";
                    array_push($errors, $er_password);
                }
            }

            if (empty($_POST["last"])) {
                $er_lname = "Last name required";
                array_push($errors, $er_lname);
            } else {
                $lname = test_input($_POST["last"]);
                if (!preg_match("/([a-zA-Z])+/", $lname)) {
                    $er_lname = "Last name should be one word, use only letters";
                    array_push($errors, $er_lname);
                }
            }

            if (empty($_POST["username"])) {
                $er_username = "Create username required";
                array_push($errors, $er_username);
            } else {
                $username = test_input($_POST["username"]);
                if (!preg_match("/([a-zA-Z0-9])+/", $username)) {
                    $er_username = "Use letters and digits only, one word";
                    array_push($errors, $er_username);
                }
            }

            if (empty($_POST["city"])) {
                $er_city = "City required";
                array_push($errors, $er_city);
            } else {
                $city = test_input($_POST["city"]);
                if (!preg_match("/([a-zA-Z])+/", $city)) {
                    $er_city = "City should be one word, use letters only";
                    array_push($errors, $er_city);
                }
            }

            if (empty($_POST["zip"])) {
                $er_zip = "ZIP code required";
                array_push($errors, $er_zip);
            } else {
                $zip = test_input($_POST["zip"]);
                if (strlen($zip) != 4) {
                    $er_city = "ZIP code should be 4 digits long";
                    array_push($errors, $er_city);
                }
            }

            if (empty($_POST["email"])) {
                $er_email = "Email required";
                array_push($errors, $er_email);
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $er_email = "Invalid email format";
                    array_push($errors, $er_email);
                }
            }

            if (empty($_POST["phone"])) {
                $er_phone = "Phone number required";
                array_push($errors, $er_phone);
            } else {
                $phone = test_input($_POST["phone"]);
                if (!preg_match("/([0-9])+/", $phone)) {
                    $er_phone = "Use numbers only";
                    array_push($errors, $er_phone);
                }
            }
        }
        return $errors;
    }
}

function test_input($in){
    $in = trim($in);
    $in = stripslashes($in);
    $in = htmlspecialchars($in);
    return $in;
}