<?php

    function loginUser($username, $password) {
        require 'db_connect.php';
        if (authentificateUser($username,$password)) {
            return true;
        } else {
            return false;
        }
    }

    function registerUser($username, $password, $phonenumber, $email, $zipcode) {
        require 'db_connect.php';
        if (insertUserInfo($username, $password, $phonenumber, $email, $zipcode)) {
            return true;
        } else {
            return false;
        }
    }

    function viewAllPosts() {
        require 'db_connect.php';
        return selectAllPosts();
    }

    function postAPicture($header,$description,$url) {
        require 'db_connect.php';
        if (insertPost($header,$description,$url)) {
            return true;
        } else {
            return false;
        }
    }
?>