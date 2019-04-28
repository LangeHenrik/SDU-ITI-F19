<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */


class UserDAO extends Connection
{


    private $conn = null;

    public function __construct()
    {
        parent::__construct();
        $this->conn = parent::getConnection();
    }

    public function getUserName($id)
    {

        $query = "SELECT username FROM users WHERE id = :id;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch();
        $username = $result['username'];

        return $username;
    }

    public function getUserByUsername($username) {
        $query = "select * from users where username=:username";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        if($result) {
            return $this->convertDBUser($result[0]);
        } else {
            return null;
        }
    }

    public function userExists($username) {
        $result = $this->getUserByUsername($username);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser()
    {
        $userId = $_SESSION['id'];
        $query = 'SELECT * FROM users where id =:id';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $userId);
        $statement->execute();
        $result = $statement->fetch();
        if($result != null) {
            return $this->convertDBUser($result);
        }
    }
    public function getUserById($id)
    {

        $userId = $id;
        $query = 'SELECT * FROM users where id =:id';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $userId);
        $statement->execute();
        $result = $statement->fetch();
        if($result != null) {
            return $this->convertDBUser($result);
        }
    }

    public function getAllUsers()
    {
        $query = "Select * from users";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        if($users != null) {
            return $this->convertToUsersArray($users);
        }

    }

    public function searchUsers($searchParam)
    {

        $searchParam = htmlentities($searchParam);
        $searchParam = "%$searchParam%";

        $DBQuery = "select * from users where username LIKE :nameSearch;";
        $statement = $this->conn->prepare($DBQuery);
        $statement->bindParam(':nameSearch', $searchParam);
        $statement->execute();
        $users = $statement->fetchAll();
        if($users != null) {
            return $this->convertToUsersArray($users);
        }
    }

    public function registerUser($user)
    {
        $firstname = htmlentities($user->getFirstName());
        $lastname = htmlentities($user->getLastName());
        $password = htmlentities($user->getPassword());
        $username = htmlentities($user->getUsername());
        $zipcode = htmlentities($user->getZip());
        $city = htmlentities($user->getCity());
        $email = htmlentities($user->getEmail());
        $phonenumber = htmlentities($user->getPhoneNumber());
        $firstlogin = htmlentities($user->getFirstLogin());


        $hash = password_hash($password, PASSWORD_DEFAULT);




        $query = 'INSERT INTO 
                  users(firstname, lastname, username, password, zip, city, email, phonenumber, first_login) 
                  VALUES(:firstname,:lastname,:username,:password,:zip,:city,:email,:phonenumber, :firstlogin)';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hash);
        $statement->bindParam(':zip', $zipcode);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phonenumber', $phonenumber);
        $statement->bindParam('firstlogin', $firstlogin);
        $success = $statement->execute();
        return $success;

    }

    private function convertToUsersArray($fetchedUsers)
    {
        $users = array();
        if (is_array($fetchedUsers)) {
            foreach ($fetchedUsers as $fetchedUser) {
                $user = $this->convertDBUser($fetchedUser);
                array_push($users, $user);
            }

            return $users;

        }elseif($fetchedUsers instanceof User) {
            return $this->convertDBUser($fetchedUsers);
        }

    }

    private function convertDBUser($fetchedUser) {

        $user = new User();


        $user->setId($fetchedUser['id']);
        $user->setCity($fetchedUser['city']);
        $user->setEmail($fetchedUser['email']);
        $user->setFirstLogin($fetchedUser['first_login']);
        $user->setFirstname($fetchedUser['firstname']);
        $user->setLastname($fetchedUser['lastname']);
        $user->setUsername($fetchedUser['username']);
        $user->setPassword($fetchedUser['password']);
        $user->setPhonenumber($fetchedUser['phonenumber']);
        $user->setZip($fetchedUser['zip']);


        return $user;
    }


}