<?php
class User extends Database{
    public function login($username, $password){

        $sql = 'SELECT username, password FROM accounts WHERE username = :username';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('username',$username);
        $stmt->execute();
        $users = $stmt->fetchAll();

        if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username){

            $hashedPass = hash($this->hashAlgo, $password);
            if($hashedPass == $users[0]['password']){
                $_SESSION['logged_in'] = true;
                return true;
            }
        }
        return false;
    }

    public function APIlogin($username, $password){

        $sql = 'SELECT username, password FROM accounts WHERE username = :username';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('username',$username);
        $stmt->execute();
        $users = $stmt->fetchAll();

        if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username){

            $hashedPass = hash($this->hashAlgo, $password);
            if($hashedPass == $users[0]['password']){
                return true;
            }
        }
        return false;
    }

    public function register($username, $password, $name, $zip, $city, $email, $ph_number){
        $sql = 'INSERT INTO accounts (username, password, name, zip, city, email, ph_number) VALUES (:username, :password, :name, :zip, :city, :email, :ph_number)';
        $stmt = $this->connection->prepare($sql);
        $hashedPass = hash($this->hashAlgo, $password);
        $stmt->bindParam('username',$username);
        $stmt->bindParam('password',$hashedPass);
        $stmt->bindParam('name',$name);
        $stmt->bindParam('zip',$zip);
        $stmt->bindParam('city',$city);
        $stmt->bindParam('email',$email);
        $stmt->bindParam('ph_number',$ph_number);
        $stmt->execute();
    }
    public function checkForUser($username){
        $sql = 'SELECT username FROM accounts WHERE username = :username';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('username',$username);
        $stmt->execute();
        $users = $stmt->fetchAll();
        if(sizeof($users) == 0){
            return false;
        } else {
            return true;
        }
    }

    public function getAllUsers(){
        $sql = 'SELECT ID, username FROM accounts';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
}