<?php
class User extends Database {

    public $name;
    public $hashed_password;
    public $city;
    public $email;

    public function checkPassword($password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return ($hashed_password == $this->hashed_password);
    }

    public function __toString() {
        return $this->name;
    }

    // username may only contain letters A-Z and digits 0-9, maximum length 30 chars
    public function checkUsername() {
        if (strlen($this->name) <= 0 || strlen($this->name) > 30) {
            return false;
        }
        return preg_match('/^[a-zA-Z0-9]*$/', $str);
    }

    // // checks if user exists
    // public function findUser($name) {
    //     $sql = "SELECT username FROM Users WHERE username = :username";
    //     $statement = $conn->prepare($sql);
    //     $statement->bindParam(":username", $name);
    //     $statement->execute();
    //     $result = $statement->fetchAll();
    //     if ($result && $statement->rowCount() == 1) {
    //         // user already exists
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // // returns all users and their data (name, city, mail)
    // public function getAllUsers() {
    //     try {
    //         $sql = "SELECT username, city, email FROM Users";
    //         $statement = $conn->prepare($sql);
    //         $statement->execute();
    //         $result = $statement->fetchAll();
    //         return $result;
    //     } catch (PDOException $e) {
	// 		echo "Error: " . $e->getMessage();
    //     }
    // }

    // // creates a new user
    // public function createUser($name, $password, $city, $email) {
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //     try {
    //         $sql = "INSERT INTO Users (username, password, city, email) values (:username,:password, :city, :email)";
    //         $statement = $conn->prepare($sql);
    //         $statement->bindParam(":username", $name);
    //         $statement->bindParam(":password", $hashed_password);
    //         $statement->bindParam(":city", $city);
    //         $statement->bindParam(":email", $email);
    //         $statement->execute();
    //     } catch (PDOException $e) {
	// 		echo "Error: " . $e->getMessage();
    //     }
    // }

}
