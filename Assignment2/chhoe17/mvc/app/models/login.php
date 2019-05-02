<?php

require_once ("../Core/database.php");

class Login extends Database {

    public function loginUser($name, $password) { 

        session_start();

        if (isset($_POST['submit'])) {

            // then get the data from the login form
            $name = $_POST['name'];
            $password = $_POST['password'];
        
            //Error handlers
            //Error handlers are important to avoid any mistakes the user might have made when filling out the form!
            //Check if inputs are empty
            if (empty($name) || empty($password)) {
                header("Location: ../views/home?login=empty");
                exit();
            }    
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=:name");  // Changed $db to $conn to use the connection from DBH.INC.PHP
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
            if (!$stmt->execute()) {   // Added the ! to say "if this doesn't work, redirect to error"
                header("Location: ../views/homelogin=error");
                exit();
            } else { 
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //de-hashing the password
                    $hashedpasswordCheck = password_verify($password, $row['password']);
                    if ($hashedpasswordCheck == false) {
                        header("Location: ../views/home?login=error");
                        exit();
                    } else if ($hashedpasswordCheck == true) {
                        //Log in the user here
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_name'] = $row['username'];
                        header("Location: ../views/home?login=success");
                        exit();
                    }
                } else {
                header("Location: ../views/home?login=error");
                exit();
                }     
            }  
        }



    }

}

