<?php

require "connection.php";

session_start();
if (!isset($_SESSION["id"])) {
    header("location: login.php");
}
$userid = $_SESSION["id"];
$has_error = false;
$title_error = "";
$description_error = "";
$image_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
        $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        $stmt = $conn->prepare("INSERT INTO post(user_id, title, description, extension) values(:userId, :title, :description, :extension)");
        $stmt->bindParam(":userId", $userid);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":extension", $imageFileType);
        $stmt->execute();

        $postId = $conn->lastInsertId();
        $target_file = "pictures/" . $postId . "." . $imageFileType;
        move_uploaded_file($image["tmp_name"], $target_file);

    } else {
        echo "Had error";
    }
}


$stmt = $conn->prepare("SELECT user_id, title, description, post_id, extension FROM post order by post_id desc limit 20");
$stmt->execute();


?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturefeeding</title>
    <link href="style/feed.css" rel="stylesheet">
    <script>
        function deletePost(postid) {
            const request = new XMLHttpRequest();
            request.addEventListener("load", ()=> {
                console.log("Deleted");
                document.getElementById("entry-" + postid).remove();
            })
            request.open('DELETE', "/deletepost.php?postid=" + postid);
            request.send();
        }
    </script>

</head>
<body>
<div>
    <a href="users.php" class="signout">User list</a>
</div>
<div>
    <a href=logout.php class="signout">Sign out</a>
</div>


<h1 class="headertitle">Picturefeeding</h1>

<form id="feedpage" style="text-align: center" action="index.php" method="post" enctype="multipart/form-data">
    <div>
        <input class="picturetitle" type="text" placeholder="Title" name="title">
        <?php
        if ($title_error) {
            echo '<span class="error">' . $title_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="picturedescription" type="text" placeholder="Make a comment to your picture" name="description">
        <?php
        if ($description_error) {
            echo '<span class="error">' . $description_error . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="fileinput" type="file" accept="image/*" name="image">
        <?php
        if ($image_error) {
            echo '<span class="error">' . $image_error . "</span>";
        }
        ?>
    </div>
    <br>
    <div>
        <button class="uploadPictureButton" type="submit">Upload picture</button>
    </div>
</form>

<div class="picturelist">
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="entry" id="entry-' . htmlspecialchars($row['post_id']) . '">'
        ?>
            <h2 class="title"><?= htmlspecialchars($row["title"]) ?></h2>
            <?php
            echo '<img src="pictures/' . htmlspecialchars($row["post_id"]) . "." . htmlspecialchars($row["extension"]) . '" />'
            ?>
            <p class="description"><?= htmlspecialchars($row["description"]) ?></p>
            <?php
            if ($row["user_id"] == $userid) {
                echo '<button class="button" type="button" onclick="deletePost('. htmlspecialchars($row["post_id"]) . ')">Delete post</button>';
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>
</div>

<script>

</script>

</body>
</html>