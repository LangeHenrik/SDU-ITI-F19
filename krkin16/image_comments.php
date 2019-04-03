<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require "handle_user_settings.php";
if (!isset( $_SESSION["user_name"])) {
    header('Location: login.php', true, 302);
    die();
} else {
}
?>



<html>
<head>
    
	<script src="include_html.js"></script>
	<title>Spacebook</title>
    <!--<link rel="stylesheet" href="login_style.css"> -->
    <link rel="stylesheet" href="feed_style.css">
</head>
<body>
    <div class="headernav">
	   <div w3-include-html="header.php"></div>
        <?php echo "<h2>Welcome Home, </h2>";
            echo "<h3 id='user_name'>" . $_SESSION["user_name"] . "</h3";?>
    </div>
    <div class="sidebar">
        <form method="post">
            <input type="submit" value="Home" name="home">
        </form>
        <form method="post">
            <input type="submit" value="My Images" name="my_images">
        </form>
        <form method="post">
            <input type="submit" value="Log out!" name="log_out" >
        </form>
    </div>
    
	<div class = "full" id="full">
        
        
        <div class = "image_post">
        
                <?php
                    require "database.php";
                    $imageId = $_GET["image_id"];
                    $image =  getImage($imageId);
        
                    echo "<div class='info'>" .
                        "<h1>" . htmlentities($image->title) . "</h1>" .
                        "<h2>User: " . htmlentities(getUser($image->user)) . "</h2>" .
                        "<p>User: " . htmlentities($image->description) . "</p>" .
                        "</div>" .
                        "<img src='" . htmlentities($image->imagePath) . "' alt='User image'>" .
                        "<caption>" . htmlentities($image->imageDate) . "</caption>";
                ?>
        </div>
            <h2>Comments</h2>
            <?php
                $comments = getComments($imageId);
                foreach($comments as $comment) {
                    echo "<div class = 'image_post'>" .
                            "<div class='info'>" .
                                "<h1>" . htmlentities($comment->user) . "</h1>" .
                                "<p>" . htmlentities($comment->text) . "</p>" .
                            "</div>" .
                        "</div>";
                }
            ?>
            <h2>Comment on the post</h2>
        <section class = "upload_image">
            <form method="post" id="post_comment" enctype="multipart/form-data">
                <textarea name ="text" form="post_comment" placeholder="Description"></textarea>
                <input type="submit" value="Post comment" id="submit" name="submit_comment">
            </form>
            
        </section>
    </div>
</body>
</html>


<?php
    if(isset($_POST["submit_comment"])) {
        if($_POST["text"]!=="") {
            
            $text = $_POST["text"];
            $user = $_SESSION["user_name"];
            
            submitComment($text, $image->id, $user);
            header("Location: image_comments?image_id=" . $image->id); //Make sure the same form can't be sent twice!
            exit; // Location header is set, pointless to send HTML, stop the script
        }
    }



