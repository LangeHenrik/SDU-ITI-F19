<?php

namespace services;

use core\Database;
use models\ImageResponse;
use models\Post;
use PDO;

class PostService extends Database
{

    public function newPost($userid, $image, $description, $title)
    {
        if (is_string($image)) {
            $stmt = $this->conn->prepare('INSERT INTO post(user_id, title, description, file) VALUES(:userId, :title, :description, :file)');
            $stmt->bindParam(":userId", $userid);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":file", $image);
            $stmt->execute();
            $postId = $this->conn->lastInsertId();
            return $postId;

        } else {
            $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
            $stmt = $this->conn->prepare("INSERT INTO post(user_id, title, description, extension) values(:userId, :title, :description, :extension)");
            $stmt->bindParam(":userId", $userid);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":extension", $imageFileType);
            $stmt->execute();

            $postId = $this->conn->lastInsertId();
            $target_file = "pictures/" . $postId . "." . $imageFileType;
            error_log("cwd: " . getcwd());
            move_uploaded_file($image["tmp_name"], $target_file);
            return $postId;
        }
    }

    public function deletePost($postid)
    {
        $userid = $_SESSION["id"];

        $stmt = $this->conn->prepare("SELECT user_id, extension FROM post WHERE post_id =:postid");
        $stmt->bindParam(":postid", $postid);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            return;
        }

        if ($userid != $post["user_id"]) {
            http_response_code(401);
            return;
        }

        $extension = $post["extension"];

        $stmt = $this->conn->prepare("DELETE FROM post WHERE post_id =:postid");
        $stmt->bindParam(":postid", $postid);
        $stmt->execute();
        unlink("pictures/$postid.$extension");
    }

    /**
     * @return Post[]
     */
    public function loadPosts()
    {
        $stmt = $this->conn->prepare("SELECT user_id, title, description, post_id, file, extension FROM post order by post_id desc limit 20");
        $stmt->execute();
        return $this->fillPosts($stmt);
    }

    /**
     * @param $userid
     * @return Post[]
     */
    public function loadPostsByUser($userid)
    {
        $stmt = $this->conn->prepare("SELECT user_id, title, description, post_id, file, extension FROM post WHERE user_id = :userid ORDER BY post_id DESC LIMIT 20");
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
        return $this->fillPosts($stmt);
    }

    /**
     * @param $stmt
     * @return Post[]
     */
    private function fillPosts($stmt)
    {
        $posts = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post($row['post_id'], $row['title'], $row['description'], $row["extension"], $row["user_id"], $row["file"]);
            $posts[] = $post;
        }
        return $posts;
    }
}