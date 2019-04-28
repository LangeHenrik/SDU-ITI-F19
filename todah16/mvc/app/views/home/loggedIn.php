<?php include '../app/views/partials/header.php'; 
    include_once "../app/core/Database.php";

?>

You are now logged in!
<br><br>
<form method="POST" action="/mvc/public/home/logout">
	<input type="submit" />
</form>

<?php
    
        
        foreach ($viewbag as $image){
    echo '<p class="upload_section">'.htmlentities($image->user_name).' uploaded:</p>';
                echo "<img src='../includes/Uploads/".$image->name."' >";
            echo "<h1>Description:</h1>";    
            echo "<p class=description>".$image->description."</p>";
                
                //echo "<form action='includes/image_comment.inc.php?id=".htmlentities($value)."'method='post'>";
                
            
    
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
        
    ?>