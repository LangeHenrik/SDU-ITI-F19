<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 26-04-2019
 * Time: 10:54
 */

namespace controllers;

use core\Controller;
use models\ImageResponse;
use models\UserResponse;
use models\AddPostResponse;
use services\AuthenticationService;
use services\PostService;
use services\UserService;


class APIController extends Controller
{

    public function users()
    {
        $userservice = new UserService();
        $users = $userservice->loadUsers();

        $userResponse = array();
        foreach ($users as $user) {
            $userResponse[] = new UserResponse($user->userid, $user->username);
        }
        echo json_encode($userResponse);
    }

    public function pictures($_, $user_id)
    {
        if ($this->post()) {
            $jsontext = $_POST["json"];
            $json = json_decode($jsontext, true);

            $image = $json["image"];
            $title = $json["title"];
            $description = $json["description"];
            $username = $json["username"];
            $password = $json["password"];

            $authservice = new AuthenticationService();

            if (!$authservice->authenticate($username, $password)) {
                http_response_code(401);
                return;
            } else {
                $user_id = $_SESSION["id"];

                $postservice = new PostService();
                $postid = $postservice->newPost($user_id, $image, $description, $title);
                $response = new AddPostResponse($postid);

                echo json_encode($response);
            }

        } else {
            $postservice = new PostService();
            $posts = $postservice->loadPostsByUser($user_id);

            $imageResponse = array();
            foreach ($posts as $post) {
                $imageResponse[] = new ImageResponse($post->id, $post->getImageFile(), $post->title, $post->description);
            }
            echo json_encode($imageResponse);
        }

    }


}