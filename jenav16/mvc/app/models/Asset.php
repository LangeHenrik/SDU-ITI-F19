<?php

Class Asset extends Database
{
    public $username;
    public $fileID;
    public $headline;
    public $text;

    public function isFileIDAvailable()
    {
        $stmt = $this->conn->prepare("SELECT fileID FROM Assets WHERE fileID = :fileID");
        $stmt->bindParam(":fileID", $this->fileID);
        $stmt->execute();
        $executed = $stmt->fetchAll();
        if ($executed != null) {
            return false;
        }
        return true;
    }

    public function uploadAsset()
    {
        $stmt = $this->conn->prepare("INSERT INTO Assets (username,fileID,headline,text,date) values (:username,:fileID,:headline,:text,NOW())");
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":fileID", $this->fileID);
        $stmt->bindParam(":headline", $this->headline);
        $stmt->bindParam(":text", $this->text);
        $stmt->execute();
    }

    public function deleteAsset(){

        $statement = $this->conn->prepare("DELETE FROM Assets WHERE fileID = :fileID");
        $statement->bindParam(":fileID", $this->fileID);
        $statement->execute();
    }

    public function getAllAssetsForUser(){
        $stmt = $this->conn->prepare("SELECT fileID, username, headline, text FROM Assets WHERE username =:username ORDER BY date DESC LIMIT 20");
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $executed = $stmt->fetchAll();
        return$executed;
    }

    public function getAllAssets(){
        $query = "SELECT fileID, username, headline, text FROM Assets ORDER BY date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $executed = $stmt->fetchAll();
        return $executed;

    }

}