<?php


require_once("../../app/Core/database.php");
require_once("../../app/Core\Controller.php");

class getUsersAPI extends Database
{
  public function users(){
    include_once("../../app/models/user.php");
    $users = $this->model('User')->getUsersAPI();
    header("Content-Type:application/json");
    $user = $users[0]['username'];
    echo json_encode($users);
  }

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
