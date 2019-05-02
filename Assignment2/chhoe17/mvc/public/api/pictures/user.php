<?php

//require_once("../../Core/database.php");
require_once("../../../app/Core/database.php");


class API extends Database {
    public function getPictures() {
        $id = $_GET['id'];
       // $conn = Connect;
        $pictures = array();
        $data = $this->conn->prepare('SELECT * FROM pictures WHERE userid = "'.$id.'"');
        $data->execute();
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $pictures[] = array(
                'image_id' => $OutputData['image_id'],
                'title' => $OutputData['title'],
                'description' => $OutputData['description'],
                'image' => $OutputData['image'],
            );
        }

        return json_encode($pictures);
    }

    public function uploadPicture() {
    
        $json = $_POST['json'];
        $id = $_GET['id'];

        $jsondata = json_decode($json, true);

        $username = $jsondata['username'];
        $password = $jsondata['password'];


        $stmt = $this->conn->query("SELECT * FROM users WHERE username = '".$username."'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //de-hashing the password
                $hashedpasswordCheck = password_verify($password, $row['password']);
                if ($hashedpasswordCheck == true) {
                    if ($row['user_id'] == $id) {
                        $title = $jsondata['title'];
                        $description = $jsondata['description'];
                        $image = $jsondata['image'];

                        $picture = 'INSERT INTO pictures (title, description, userid, image) 
                            VALUES (:title, :description, :userid, :image);';
                                $stmt = $this->conn->prepare($picture);
                                $stmt->bindParam(":title", $title);
                                $stmt->bindParam(":description", $description);
                                $stmt->bindParam(":userid", $id);
                                $stmt->bindParam(":image", $image);
                                $stmt->execute();

                                $image_id = $this->conn->lastInsertId();

                            return json_encode(array('image_id' => $image_id));
                    }
            } else {
                exit();
            } 
    }
}

$API = new API;

header('Content-Type: application/json');

if ($_POST){
    echo $API->uploadPicture();
    echo $API->getPictures();
    
    
} else {
    echo $API->getPictures();
}


