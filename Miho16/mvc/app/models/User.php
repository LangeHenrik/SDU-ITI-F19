<?php
class User extends Database
{
    public $username;
    public $password;
    public $password2;
    public $firstname;
    public $lastname;
    public $zip;
    public $city;
    public $mail;
    public $phonenumber;
    public function getUserByUsername()
    {
        $stmt = $this->conn->prepare("SELECT username,password,firstName FROM userdb WHERE username = :username");
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $executed = $stmt->fetchAll();
        return $executed[0];
    }
    public function isUsernameAvailable()
    {
        $stmt = $this->conn->prepare("SELECT username FROM userdb WHERE username = :username");
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $executed = $stmt->fetchAll();
        if ($executed!= null){
            return false;
        }
        return true;
    }
    public function registerUser()
    {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO userdb (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) values (:username,:password,:firstName,:lastName,:zip,:city,:emailAddress,:phoneNumber,NOW())");
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":firstName", $this->firstname);
        $stmt->bindParam(":lastName", $this->lastname);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":emailAddress", $this->mail);
        $stmt->bindParam(":phoneNumber", $this->phonenumber);
        $stmt->execute();
    }
    public function getAllUsers(){
        $stmt = $this->conn->prepare("SELECT username, firstName, lastName, zip, city, emailAddress, phoneNumber FROM userdb");
        $stmt->execute();
        $executed = $stmt->fetchAll();
        return $executed;
    }
}
