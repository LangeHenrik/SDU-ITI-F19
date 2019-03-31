<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

class UserDAO extends DAO implements iUserDAO
{


    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
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
        $user->setPassword(null);
        $user->setPhonenumber($fetchedUser['phonenumber']);
        $user->setZip($fetchedUser['zip']);
        return $user;
    }


}