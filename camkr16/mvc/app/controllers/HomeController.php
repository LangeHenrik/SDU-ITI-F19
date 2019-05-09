<?php

namespace controllers;

use services\PostService;
use core\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $postservice = new PostService();
        $posts = $postservice->loadPosts();
        $userid = $_SESSION["id"];

        return $this->view("home/index", array("user_id"=>$userid, "posts"=>$posts));
    }

    public function addNewPost()
    {
        $newPost = new PostService();

        $userid = $_SESSION["id"];
        $has_error = false;
        $title_error = "";
        $description_error = "";
        $image_error = "";

        if ($this->post()) {

            $title = $_POST["title"];
            $description = $_POST["description"];
            $image = $_FILES["image"];
            $check = getimagesize($image["tmp_name"]);

            if ($check == false) {
                $has_error = true;
                $image_error = "Not a image";
            }
            if (empty($title)) {
                $has_error = true;
                $title_error = "Title is required";
            }
            if (empty($description)) {
                $has_error = true;
                $description_error = "Description is required";
            }
            /**
             * @var PDO $conn
             */
            if (!$has_error) {
                $newPost->newPost($userid, $image, $description, $title);

            } else {
                echo "Had error";
            }
        }

        header("Location: /camkr16/mvc/public/");
    }

    public function deletePost($postid)
    {
        $deletePost = new PostService();
        $deletePost->deletePost($postid);

    }

}