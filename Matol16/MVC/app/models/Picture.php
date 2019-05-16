<?php
class Picture extends Database {
    public function getAllPictures(){
        $sql = "SELECT * FROM pictures";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $pictures = $stmt->fetchAll();
        return $pictures;
    }

    public function getUserPictures($userID){
        $sql = "SELECT picturelink, header, description FROM pictures WHERE posterID = :userID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('userID',$userID);
        $stmt->execute();
        $pictures = $stmt-> fetchAll();
        return $pictures;
    }

    public function addPicture($header, $desc, $link){
        $sql ='INSERT INTO pictures (header, picturelink, description) VALUES (:header,:link, :desc)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('header', $header);
        $stmt->bindParam('link', $link);
        $stmt->bindParam('desc', $desc);
        $stmt->execute();
    }
    public function addPictureAPI($header, $desc, $link){
        $sql ='INSERT INTO pictures (header, picturelink, description) VALUES (:header,:link, :desc)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('header', $header);
        $stmt->bindParam('link', $link);
        $stmt->bindParam('desc', $desc);
        $stmt->execute();
        $sql = 'SELECT ID FROM pictures WHERE picturelink = :link';
        $stmt = $this->connection->prepare(($sql));
        $stmt->bindParam('link', $link);
        $stmt->execute();
        $pictureID = $stmt->fetch();
        return $pictureID->ID;

    }
}
