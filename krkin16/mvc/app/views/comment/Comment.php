<html>
<head>
    
	<script src="include_html.js"></script>
	<title>Spacebook</title>
    <!--<link rel="stylesheet" href="login_style.css"> -->
    <link rel="stylesheet" href="/krkin16/mvc/app/views/css/feed_style.css">
</head>
<body>
    <div class="headernav">
	   <div w3-include-html="header.php"></div>
        <?php echo "<h2>Welcome Home, </h2>";
            echo "<h3 id='user_name'>" . $_SESSION["user_name"] . "</h3";?>
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
    </div>
    
	<div class = "full" id="full">
        
        
        <div class = "image_post">
		
				<div class='info'>
                        <h1><?=$viewbag["image"]->title?></h1>
                        <h2><?=$viewbag["image"]->user?></h2>
                        <p>User: <?=$viewbag["image"]->description?></p>
                        <img src="\krkin16\mvc\public\<?=$viewbag["image"]->imagePath?>" alt='User image'>
                        <caption><?=$viewbag["image"]->imageDate?></caption>
				
				</div>
            <h2>Comments</h2>
            <?php foreach($viewbag["comments"] as $comment) {?>
					
                    <div class = 'image_post'>
						<div class='info'>
							<h1><?=$comment->user?></h1>
							<p><?=$comment->text?></p>
						</div>
					</div>
			<?php } ?>
            
            <h2>Comment on the post</h2>
        <section class = "upload_image">
            <form method="post" id="post_comment" enctype="multipart/form-data" action="/krkin16/mvc/public/comment/postComment/<?=$viewbag["image"]->id?>">
                <textarea name ="text" form="post_comment" placeholder="Description"></textarea>
                <input type="submit" value="Post comment" id="submit" name="submit_comment">
            </form>
            
        </section>
    </div>
</body>
</html>


