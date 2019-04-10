<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-13
 * Time: 10:52
 */

require 'DatabaseManager.php';

function loadUserElements() {

    $userElements = '';
    $users = getAllUsers();

    $count = 0;

    foreach($users as $user) {

        $classname = '';
        if($count%2 == 0 || $count == 0) {
            $classname = 'user even';
        } else {
            $classname = 'user odd';
        }

        $username = $user['username'];
        $images = getUserImagesById($user['id']);
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];



        $userElements .= "<div class='{$classname}'><h3>{$firstname} {$lastname} ({$username})</h3>";

        if($images != null) {
            $userElements .= "<div class='user-images-container'>";
            foreach ($images as $image) {
                $imagePath = 'uploads/' . $image['name'];
                $userElements .= "<img class='user-image' src={$imagePath}/>";
            }
            $userElements .= "</div>";
        } else {
            $userElements .= "<div>This user has no images yet...</div>";
        }
        $userElements .= "</div>";

        $count = $count + 1;
    }


    return $userElements;
}