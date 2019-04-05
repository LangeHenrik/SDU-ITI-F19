<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 12:25
 */
interface iCommentDAO {

    public function getImageComments($imageId);
    public function addImageComment($comment);

}