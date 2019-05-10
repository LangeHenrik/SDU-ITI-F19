<?php


require_once("../../app/Core/database.php");

class getUsersAPI extends Database
{

    public function getUsers()
    {
        $users = array();
        $data = $this->conn->prepare('SELECT * FROM users ORDER BY user_id');
        $data->execute();

        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $users[] = array(
                'user_id' => $OutputData['user_id'],
                'username' => $OutputData['username'],

            );
        }

        return json_encode($users);
    }
}

$getUsersAPI = new getUsersAPI;

header('Content-Type: application/json');

echo $getUsersAPI->getUsers();
