<?php
session_start();

require 'DatabaseManager.php';

$success = registerUser($_POST);

if($success) {
    header('Location: http://localhost:8000/PHP/PictureManagement.php');
} else {
    echo "Something went wrong..";
}