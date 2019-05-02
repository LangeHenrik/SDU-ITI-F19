<?php
    require "../app/models/UserModel.php";

class UserService extends Database
{

    public function getUsers()
    {
        $statement = $this->conn->prepare("SELECT uidUsers, emailUsers, firstNameUsers, lastNameUsers, cityUsers FROM users");
        $statement->execute();
        $users = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = new UserModel($row['uidUsers'], $row['emailUsers'], $row['firstNameUsers'], $row['lastNameUsers'], $row['cityUsers']);
            $users[] = $user;
        }
        return $users;
    }


}