<?php

class Users extends Database {

    public function getUsers () {

        $stmt =  $this->conn->prepare("SELECT username, user_Image, user_img_type FROM rafha13.siteUser");
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $users = $stmt->fetchAll();

        return $users;

        //print_r($users);

    }

}