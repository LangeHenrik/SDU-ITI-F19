<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturefeeding</title>
    <link href="/camkr16/mvc/public/style/feed.css" rel="stylesheet">
    <script>
        function deletePost(postid) {
            const request = new XMLHttpRequest();
            request.addEventListener("load", () => {
                console.log("Deleted");
                document.getElementById("entry-" + postid).remove();
            })
            request.open('DELETE', "/camkr16/mvc/public/home/deletePost/" + postid);
            request.send();
        }
    </script>

</head>
<body>

<?php
require "../app/views/partials/menu.php"
?>

<h1 class="headertitle">Picturefeeding</h1>

<form id="feedpage" style="text-align: center" action="/camkr16/mvc/public/home/addNewPost" method="post"
      enctype="multipart/form-data">
    <div>
        <input class="picturetitle" type="text" placeholder="Title" name="title">
        <?php
        if (isset($viewbag["title_error"])) {
            echo '<span class="error">' . $viewbag["title_error"] . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="picturedescription" type="text" placeholder="Make a comment to your picture" name="description">
        <?php
        if (isset($viewbag["description_error"])) {
            echo '<span class="error">' . $viewbag["description_error"] . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="fileinput" type="file" accept="image/*" name="image">
        <?php
        if (isset($viewbag["image_error"])) {
            echo '<span class="error">' . $viewbag["image_error"] . "</span>";
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
    /**
     * @var \models\Post $post
     */
    foreach ($viewbag["posts"] as $post) {
    echo '<div class="entry" id="entry-' . htmlspecialchars($post->id) . '">'

    ?>
    <h2 class="title"> <?= htmlspecialchars($post->title) ?></h2>
    <?php
    echo '<img src="' . $post->getImageFile() . '" />'
    ?>
    <p class="description"><?= htmlspecialchars($post->description) ?></p>
    <?php
    if ($post->userid == $viewbag["user_id"]) {
        echo '<button class="button" type="button" onclick="deletePost(' . htmlspecialchars($post->id) . ')">Delete post</button>';
    }
    ?>

</div>

<?php
}
?>
</div>

<script>

</script>

</body>
</html>