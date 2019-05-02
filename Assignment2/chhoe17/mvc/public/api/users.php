<?php



//require_once("../../Core/database.php");
require_once("../../app/Core/database.php");

class usersAPI extends Database
{

    public function getUsers()
    {
       // $conn = Connect;
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

$usersAPI = new usersAPI;
header('Content-Type: application/json');
echo $usersAPI->getUsers();