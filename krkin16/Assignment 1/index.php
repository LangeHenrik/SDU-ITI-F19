<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require "handle_user_settings.php";
if (!isset( $_SESSION["user_name"])) {
    header('Location: login.php', true, 302);
    die();
} else {
    require "upload.php";
}
?>



<html>
<head>
    
	<script src="include_html.js"></script>
    <script src="update_feed.js"></script>
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
        <h3>Users:</h3>
        <?php
            require "database.php";
            foreach(getUser() as $user) {
                echo "<p>" . htmlentities($user) . "</p>";
            }
        ?>
    </div>
    
	<div class = "full" id="full">
        <section class = "upload_image">
            <form method="post" enctype="multipart/form-data" id="upload_image_form">
                <label>Select image to upload:</label>
                <input type="text" name="file_name" id="file_name" placeholder="Title">
                <textarea name ="file_description" form="upload_image_form" placeholder="Description"></textarea>
                <input type="file" name="file_to_upload" id="file_to_upload">
                <input type="submit" value="Upload Image" id="submit" name="submit_image">
            </form>
            
        </section>
    </div>
</body>
<script>updateFeed(); </script>
<script>includeHTML(); </script>
</html>