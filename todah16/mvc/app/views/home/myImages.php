<?php include '../app/views/partials/header.php'; 

    echo "<p>You are logged in as ".htmlentities($_SESSION['user_name'])."</p>";
        echo '<form action="/todah16/mvc/public/service/upload" method="POST" enctype="multipart/form-data">
        
    <label for="image_description">Enter a description</label>    
    <textarea rows = "5" cols = "50" name = "description"> 
    </textarea>
    
    <p>Select image to upload:</p>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="upload">
    </form>';
        
        foreach ($viewbag as $image){
        echo '<p class="upload_section">'.htmlentities($image->user_name).' uploaded:</p>';
            echo "<img src='/todah16/mvc/public/Uploads/".$image->name."' >";
            echo "<h1>Description:</h1>";    
            echo "<p class=description>".$image->description."</p>";   
                //echo "<form action='includes/image_comment.inc.php?id=".htmlentities($value)."'method='post'>";
                
            
        echo "<form action='/todah16/mvc/public/service/comment/".htmlentities($image->id)."'method='post'>";
        echo '<div id="comment">';
        echo '<textarea rows = "3" cols = "25" name = "comment"  placeholder="Comment text."> 
        </textarea>';
        echo '</div>';
        echo '<input type="submit" value="Comment" name="comment_button">';
        echo '</form>';
        echo "</div>";
    
        foreach($viewbagExtra as $comment){
            if($image->id == $comment->id){
                echo "<div id=image_comment>";
            echo '<p class="user_section">'.htmlentities($comment->user_name).' commented:</p>';
            echo '<p class="comment_section">'.htmlentities($comment->text).'</p>'; 
            echo "</div>";
            }
                    
            
        }
    
        }
        
    