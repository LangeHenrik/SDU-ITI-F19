<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Dankify</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
    
   
    
    function deleteImage(_id){
        
        
        $.ajax({
        url: '/todah16/mvc/public/service/delete',
        type: 'POST',
        data: { 'id':_id },
        success: function(response){
            
       if(response ==1){
	 // Remove image source
        
	   var image = document.getElementById("_id");
       image.parentNode.removeChild(image);
       } else{
	   console.log('Invalid ID.');
      }
      } 

    
        });
        
    }    
        
</script>
  
    
</head>

<?php include '../app/views/partials/header.php'; 

 echo "<p>You are logged in as ".htmlentities($_SESSION['user_name'])."</p>";
    
    
    
    
    
    echo '<form action="/todah16/mvc/public/service/upload" method="POST" enctype="multipart/form-data">';
    
    echo '<div class="form-group">';
    echo '<label for="image_description">Enter a description:</label>    
    <textarea class="form-control" rows = "5" cols = "50" name = "description"> 
    </textarea>';
    echo '</div>';
    echo '<p><b>Select image to upload:</b></p>';

  
    echo '<input type="file" class = "form-control-file" name="fileToUpload" id="fileToUpload">';
    
    
    echo '<input type="submit" class = "btn btn-default" value="Upload Image" name="upload">';
    echo '</form>';
        echo "<br>";
    echo "<br>";
        foreach ($viewbag as $image){
        echo '<p class="upload_section">'.htmlentities($image->user_name).' uploaded:</p>';
            echo "<img src='/todah16/mvc/public/Uploads/".$image->name."' id=".$image->id." >";
            echo '<div class="detailBox">';
            echo "<label>Description:</label>";    
            echo '<p style="color:green;">'.$image->description.'</p>';
            echo '</div>';  
                //echo "<form action='includes/image_comment.inc.php?id=".htmlentities($value)."'method='post'>";
            
    
    echo '<button class="btn-danger" onclick="deleteImage('.$image->id.')">Delete</button>';
    
            
   
            echo "<br>";
        echo "<form action='/todah16/mvc/public/service/comment/".htmlentities($image->id)."'method='post'>";
        echo '<div class ="form.row" id="comment">';
        echo '<textarea class="form-control" rows = "3" cols = "10" name = "comment"> 
    </textarea>';
        echo '</div>';
        echo '<input type="submit" class = "btn btn-default" value="Comment" name="comment_button">';
        echo '</form>';
        echo "</div>";
    
        foreach($viewbagExtra as $comment){
            if($image->id == $comment->id){
                echo "<div id=image_comment>";
            echo '<p class="user_section">'.htmlentities($comment->user_name).' commented:</p>';
            echo '<p style="color:green;" >'.htmlentities($comment->text).'</p>'; 
            echo "</div>";
            }
                    
            
        }
    
        }
        

  ?>
    

    
    