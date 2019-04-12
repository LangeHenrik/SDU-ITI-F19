<?php
require_once (__DIR__.'/Components/PostRender.php');
require_once(__DIR__ . '/../Model/postDAO.php');
require_once(__DIR__.'./Components/RequireLogin.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__.'/Components/NavigationBar.php'); ?>

    <h1>Upload new image </h1>



    <h1> Your images </h1>
    <?php
        $posts = getUserPosts($_SESSION['user_id']);
        foreach($posts as $post){
            echo renderFuckingPost($post);
        }
    ?>
</div>

</body>
</html>