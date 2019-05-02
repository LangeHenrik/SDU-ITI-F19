<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 02/05/2019
 * Time: 10.56
 */

namespace models;


class pictureModel extends Database
{

    /**
     * @return mixed
     * For now returns 20 images.
     */
    public function getAllPictures(){
        $sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT 20";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $pictures = $stmt->fetchAll();
        return $pictures;
    }

}