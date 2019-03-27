<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

class UserDAO extends DAO
{


    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
    }

    function getUserName($id)
    {

        $query = "SELECT username FROM users WHERE id = :id;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $result = $statement->fetch();
        $username = $result['username'];


        return $username;
    }

    function getCurrentUser()
    {
        $userId = $_SESSION['id'];
        $query = 'SELECT * FROM users where id =:id';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $userId);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    function getAllUsers()
    {
        $query = "Select * from users";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        return $users;

    }

    function searchUsers($nameSearch)
    {

        $nameSearch = "%$nameSearch%";

        $DBQuery = "select * from users where username LIKE :nameSearch;";
        $statement = $this->conn->prepare($DBQuery);
        $statement->bindParam(':nameSearch', $nameSearch);
        $statement->execute();
        $users = $statement->fetchAll();
        return $users;
    }

    function registerUser($user)
    {
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $password = $user->getPassword();
        $username = $user->getUsername();
        $zipcode = $user->getZip();
        $city = $user->getCity();
        $email = $user->getEmail();
        $phonenumber = $user->getPhoneNumber();
        $firstlogin = $user->getFirstLogin();


        $query = 'INSERT INTO 
                  users(firstname, lastname, username, password, zip, city, email, phonenumber, first_login) 
                  VALUES(:firstname,:lastname,:username,:password,:zip,:city,:email,:phonenumber, :firstlogin)';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':zip', $zipcode);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phonenumber', $phonenumber);
        $statement->bindParam('firstlogin', $firstlogin);
        $success = $statement->execute();
        return $success;

    }




}