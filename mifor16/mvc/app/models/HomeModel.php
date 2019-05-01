<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 12:47
 */

namespace models;

use core\Database;
use PDO;
use services\ImageConversionService;

class HomeModel extends Database
{

    public function getBase64Images() {
        $imageService = new ImageConversionService();
        $posts = $this->getImages();
        $newArray = $imageService->convertArray($posts);
        return $newArray;
    }

    public function getImages() {

        $statement = $this->conn->prepare('select * from images order by image_id DESC LIMIT 20');

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();


        return $result;
    }
}