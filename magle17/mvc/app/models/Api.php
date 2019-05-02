<?php

class Api extends Database {

    public function __construct(){
        parent::__construct();
    }


    public function getUsers(){
        $stmtgetusers=$this->conn->prepare('SELECT id as user_id,username from users');
        $stmtgetusers->execute();
        $stmtgetusers->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmtgetusers->fetchAll();
        return $result;
    }

    public function getUserImages($id){
        $stmtgetuserimage=$this->conn->prepare('SELECT media_name as image,title,description from media where uploaded_by=:id');
        $stmtgetuserimage->bindParam(':id',$id,PDO::PARAM_INT);
        $stmtgetuserimage->execute();
        $stmtgetuserimage->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmtgetuserimage->fetchAll();
        return $result;
    }
    public function checkLogin($username,$password){
        $getpswd=$this->conn->prepare("SELECT id, password from users where username=:username");
        $getpswd->bindParam(":username",$username);
        $getpswd->execute();
        $getpswd->setFetchMode(PDO::FETCH_ASSOC);
        $result=$getpswd->fetchAll();
        if(!password_verify($password,$result[0]["password"])){
            return "Incorrect username or password.";
        }
        return $result[0]["id"];

    }

    public function saveImage($userid,$image,$title,$description){
        $insert=$this->conn->prepare("INSERT INTO media (uploaded_by, media_name,title,description) VALUES(:userid,:media,:title,:description)");
        $insert->bindParam(":userid",$userid);
        $insert->bindParam(":media",$image);
        $insert->bindParam(":title",$title);
        $insert->bindParam(":description",$description);

        $insert->execute();
        $id=$this->conn->lastInsertId();
        return $id;

    }
}
?>