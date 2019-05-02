<?php

require_once ("../Core/database.php");

class Logout extends Database {

    public function logoutUser() { 

        if (isset($_POST['submit'])) {
            session_start();
            //Then delete all SESSION variables
            session_unset();
            //And destroy the current session that is running
            session_destroy();
            header("Location: ../views/home");
            exit();
        }
}
}