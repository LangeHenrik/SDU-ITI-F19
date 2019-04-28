<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 12:25
 */

interface iImageDAO{

    public function getAllImages();
    public function getUserImages();
    public function getUserImagesById($userId);
    public function deleteImage($imageId);

}