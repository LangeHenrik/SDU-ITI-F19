<?php



namespace models;
use core\Database;
//use PDO;
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
  //      $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}