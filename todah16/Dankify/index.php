<?php

        require "Dankify_header.php";
        require 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file   
<link rel="stylesheet" type="text/css" href="\CSS\Dankify_FEED.css"/>
--> 
    
</head>     
    
<body>
    
<!--
Form that creates an upload button for the website along sending the form to the upload.inc.php file on a successful upload.
-->    

 <main>
     <section class = "section-default">     
    <?php
    if(isset($_SESSION['user_name'])){
        echo "<p>You are logged in as ".htmlentities($_SESSION['user_name'])."</p>";
        echo '<form action="includes\upload.inc.php" method="POST" enctype="multipart/form-data">
        
    <label for="image_description">Enter a description</label>    
    <textarea rows = "5" cols = "50" name = "description"> 
    </textarea>
    
    <p>Select image to upload:</p>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="upload">
    </form>';
        
    $query = "SELECT * FROM images;";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        exit();
    }
    
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        echo '<style>
        .comment {
      width: 40%;
      height: 100px;
      padding: 10px;
      background-color: #d0e2bc;
      }
      
    input[type=button], input[type=submit], input[type=file] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

p.comment_section{
color: green;

}

p.description{
 padding: 16px 32px;
border: none;
background-color: #D3D3D3;
color: green;

}

p.user_section{
 background-color: #4CAF50;
    border: none;
    color: white;
    padding: 2px 5px;

}
p.upload_section{
padding: 16px 32px;
border: none;
background-color: #D3D3D3;
color: green;
}

#user_feed{
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 6px 10px;
    text-decoration: none;
    margin: 4px 2px;
}
      
    </style>';
        echo "<div id=image_feed>";
        echo '<p class="upload_section">'.htmlentities($row['user_name']).' uploaded:</p>';
        echo "<img src='includes/Uploads/".htmlentities($row['name'])."' >";
        echo "<h1>Description:</h1>";
        echo "<p class=description>".$row['description']."</p>"; 
        echo "<form action='includes/image_comment.inc.php?id=".htmlentities($row['img_id'])."'method='post'>";
        echo '<div id="comment">';
        echo '<textarea rows = "3" cols = "25" name = "comment"  placeholder="Comment text."> 
        </textarea>';
        echo '</div>';
        echo '<input type="submit" value="Comment" name="comment_button">';
        echo '</form>';
        echo "</div>";
        
        $query = "SELECT * FROM comments WHERE img_id=".htmlentities($row['img_id']).";";
        $stmt = mysqli_stmt_init($conn);  

        if(!mysqli_stmt_prepare($stmt, $query)){
            echo "There was a unexpected error.";
            exit();
        }
        
        $commentResult = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($commentResult)){
            echo "<div id=image_comment>";
            echo '<p class="user_section">'.htmlentities($row['user_name']).' commented:</p>';
            echo '<p class="comment_section">'.htmlentities($row['text']).'</p>'; 
            echo "</div>";   
        }
    
    }
        
    $query = "SELECT * FROM users;";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        exit();
    }
    echo "<h1>Users:</h1>";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        echo "<div id=user_feed>";
         echo "<p> ".htmlentities($row['user_name'])." </p>";
        echo "</div>";
    }
        
    } else {
        echo '<p>You are NOT logged in</p>';
    }        
    ?>
    
         
         
         
     
     </section>
     
</main>
</body>
    
    
</html>