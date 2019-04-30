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

class HomeModel extends Database
{
    public function getImages() {

        $statement = $this->conn->prepare('select * from images order by counter DESC LIMIT 20');

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();


        return $result;
    }
}