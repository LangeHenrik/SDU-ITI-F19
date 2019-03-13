<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-11
 * Time: 13:36
 */

session_start();

require 'DatabaseManager.php';

function loadAllImages()
{
    $images = getAllImages();
    $imageElements = "";

    foreach ($images as $image) {

        $imagePath = "uploads/" . $image['name'];
        $imageHeader = $image['header'];
        $imageText = $image['text'];
        $imageId = $image['id'];
        $imageComments = getImageComments($imageId);
        $userid = $image['user_id'];

        $ownername = getUsername($userid);

        $imageElements .= "
                <div class='image-item-container'>
                    <div class='image-item'>
                    <div class='image-container'>
                    <img class='feed-image' src='{$imagePath}'>
                    <h3 class='ownername'>{$ownername}</h3>
                    </div>
                </div>
                 <h2 class='image-title'>{$imageHeader}</h2>
                 <div class='image-description-container'>{$imageText}</div>
                 <input class='input-comment-author' type='text' placeholder='name'>
        <textarea cols='80' rows='5' placeholder='comment on the picture'></textarea>
        <button class='btnComment'>Add comment</button>
        <div class='comment-list-container'>{$imageComments}</div>
</div>";

    }
    return $imageElements;
}


function loadUsersImages()
{

    $imageElements = "";
    $images = getUserImages();

    foreach ($images as $image) {
        $imagePath = "uploads/" . $image['name'];
        $imageHeader = $image['header'];
        $imageText = $image['text'];
        $imageId = $image['id'];
        $imageComments = $image['comments'];

        $imageString = (string)$image;

        echo "{$imageString}";

        $imageElements .= "
 <div class='image-item-container'>
     <div class='image-item'>
        <img class='feed-image' src='{$imagePath}'>
    </div>
        <h2 class='image-title'>{$imageHeader}</h2>
        <div class='image-description-container'>{$imageText}</div>
        <div class='comment-list-container'>{$imageComments}</div>
</div>";

    }
    return $imageElements;

}
