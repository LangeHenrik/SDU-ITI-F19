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
        $imageComments = buildComments(getImageComments($imageId));
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
                 <form action='addComment.php' method='post'>
                 <textarea maxlength='500' cols='80' rows='5' name='comment' placeholder='comment on the picture'></textarea>
                 <button class='btnComment' name='submit'>Add comment</button>
                 <input type='hidden' name='imageId' value='$imageId'/>
                 </form>
                 <div class='comment-list-container'>{$imageComments}</div>
            </div>";

    }
    return $imageElements;
}

function buildComments($comments)
{


    $count = 0;
    $commentElements = '';


    foreach ($comments as $comment) {
        $authorName = getUserName($comment['user_id']);
        $comment = $comment['comment'];


        if($count%2 == 0 || $count == 0) {
            $classname = 'comment-container even';
        } else {
            $classname = 'comment-container odd';
        }


        $commentElements .= "<div class='{$classname}' ><h3 class='comment-author-name'>{$authorName}</h3><span class='comment-time-stamp'></span><div class='comment'>{$comment}</div></div>";
        $count = $count + 1;
    }

    return $commentElements;
}


function loadUsersImages()
{

    $imageElements = "";
    $images = getUserImages();

    if($images != null) {
        foreach ($images as $image) {
            $imagePath = "uploads/" . $image['name'];
            $imageHeader = $image['header'];
            $imageText = $image['text'];
            $imageId = $image['id'];
            $imageComments = buildComments(getImageComments($imageId));



            $imageString = (string)$image;

            $imageElements .= "
                <div class='image-item-container'>
                    <form action='deleteImage.php' method='post'>
                        <input type='hidden' name='imageId' value='{$imageId}'>
                        <button name='delete'>Delete</button>
                    </form>
                    <div class='image-item'>
                        <img class='feed-image' src='{$imagePath}'>
                    </div>
                    <h2 class='image-title'>{$imageHeader}</h2>
                    <div class='image-description-container'>{$imageText}</div>
                    <div class='comment-list-container'>{$imageComments}</div>
                </div>";

        }
    }
    return $imageElements;

}
