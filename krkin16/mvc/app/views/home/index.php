<html>
<head>
    <script src="/krkin16/mvc/app/views/home/javascript/include_html.js"></script>
    <script src="/krkin16/mvc/app/views/home/javascript/update_feed.js"></script>
	<title>Spacebook</title>
    <link rel="stylesheet" href="/krkin16/mvc/app/views/css/feed_style.css">
</head>
<body>
    <div class="headernav">
		<?php include "header.php"; ?>
    </div>
    <div class="sidebar">
        <form method="post" action="/krkin16/mvc/public/home">
            <input type="submit" value="Home" name="home" >
        </form>
        <form method="post" action="/krkin16/mvc/public/home/displayOwn">
            <input type="submit" value="My Images" name="my_images">
        </form>
        <form method="post" action="/krkin16/mvc/public/home/logout">
            <input type="submit" value="Log out!" name="log_out">
        </form>
        <h3>Users:</h3>
        <?php
            foreach($viewbag["users"] as $user) {
                echo "<p>" . htmlentities($user) . "</p>";
            }
        ?>
    </div>
    
	<div class = "full" id="full">
        <section class = "upload_image">
            <form method="post" enctype="multipart/form-data" id="upload_image_form" action="/krkin16/mvc/public/home/uploadNewImage">
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