<?php

    class User {
        public $user_id;
        public $username;

        function __construct ($id, $name) {
            $this->user_id = $id;
            $this->username = $name;
        }

    }

    # establish db connection
    require_once 'db_config.php';

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $stmt_get_users = $conn->prepare("SELECT picture_user_id, username FROM picture_user");

        $stmt_get_users->execute();
        $stmt_get_users->setFetchMode(PDO::FETCH_ASSOC);
        $result_get_users = $stmt_get_users->fetchAll();
        // print_r($result_get_users);

        # create return object with users
        $users = [];

        foreach ($result_get_users as $value) {
            $user_id = $value['picture_user_id'];
            $username= $value["username"];

            $users[] = new User($user_id, $username);
        }

    } catch (PDOexception $e) {
        echo "Error: " . $e->getMessage();
    }

    $json_users = json_encode($users, JSON_PRETTY_PRINT);

    header('Content-Type:application/json');
    echo $json_users;

    # Close db connection
    $conn = null;
 ?>
