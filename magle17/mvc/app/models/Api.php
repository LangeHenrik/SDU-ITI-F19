<?php

class Api extends Database {
    private $stmtgetusers;
    private $stmtgetuserimage;
    private $stmtpostimage;

    public function __construct(){
        parent::__construct();
        $this->stmtgetusers=$this->conn->prepare('SELECT id as user_id,username from users');
        $this->stmtgetuserimage=$this->conn->prepare('SELECT media_name as image,title,description from media where uploaded_by=:id');
    }


    public function getUsers(){
        $this->stmtgetusers->execute();
        $this->stmtgetusers->setFetchMode(PDO::FETCH_ASSOC);
        $result=$this->stmtgetusers->fetchAll();
        return $result;
    }

    public function getUserImages($id){
        $this->stmtgetuserimage->bindParam(':id',$id,PDO::PARAM_INT);
        $this->stmtgetuserimage->execute();
        $this->stmtgetuserimage->setFetchMode(PDO::FETCH_ASSOC);
        $result=$this->stmtgetuserimage->fetchAll();
        return $result;


    }

}
?>