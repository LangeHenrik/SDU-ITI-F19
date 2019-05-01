<?php

class User {	
	public $id;
    public $name;
    public $password;
    public $firstname;
    public $lastname;
    public $zip;
    public $city;
    public $email;
    public $phone;

    public function isEmpty() {
        return empty($this -> name) && empty($this -> password) &&
        empty($this -> firstname) && empty($this -> lastname) &&
        empty($this -> zip) && empty($this -> city) &&
        empty($this -> email) && empty($this -> phone);
    }

    public static function getAllUsers() {
        $sql = 'SELECT id, username as name FROM account;';

        try {
            $stmt = Database::get() -> conn -> prepare($sql);
            $stmt -> execute();

            $result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'User');

            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

	public static function login($username, $password) {
        $id = null;

		$sql = 'SELECT id, password FROM account WHERE LOWER(username) = LOWER(:username);';

        try {
            $stmt = Database::get() -> conn -> prepare($sql);
            $stmt -> bindParam(':username', $username);

            $stmt -> execute();

            $result = $stmt -> fetchAll();

            if(count($result) > 0 && password_verify($password, $result[0]['password'])) {
                $id = $result[0]['id'];
            }
        } catch (PDOException $e) {
            throw $e;
        }

        return $id;
    }

    public static function register($user) {
        $sql = 'INSERT INTO account(username, password, firstname, lastname, zip, city, email, phone) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone);';

        try {
            $stmt = Database::get() -> conn -> prepare($sql);

            $stmt -> bindParam(':username', $user -> name);
            $stmt -> bindParam(':password', $user -> password);
            $stmt -> bindParam(':firstname', $user -> firstname);
            $stmt -> bindParam(':lastname', $user -> lastname);
            $stmt -> bindParam(':zip', $user -> zip);
            $stmt -> bindParam(':city', $user -> city);
            $stmt -> bindParam(':email', $user -> email);
            $stmt -> bindParam(':phone', $user -> phone);

            if($stmt -> execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }
}