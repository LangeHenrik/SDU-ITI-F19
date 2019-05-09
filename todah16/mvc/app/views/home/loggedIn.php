<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Dankify</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
  <!--Linked to CSS file -->    
    <link rel="stylesheet" type="text/css" href="../CSS/loggedIn.css"/>
    
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
    
        


        foreach ($viewbag as $image){
        echo "<br>";    
            
        echo '<p class="upload_section">'.htmlentities($image->user_name).' uploaded:</p>';
                echo "<img class='img-thumbnail' src='../Uploads/".$image->name."' >";
             echo '<div class="detailBox">';
            echo "<label>Description:</label>";    
            echo '<p style="color:green;">'.$image->description.'</p>';
            echo '</div>';
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
                 echo '<div class="detailBox">';
            echo "<label>Comment section:</label>"; 
                echo '</div>';
                echo "<div id=image_comment>";
            echo '<p>'.htmlentities($comment->user_name).' commented:</p>';
            echo '<span class="border">';    
            echo '<p style="color:green;">'.htmlentities($comment->text).'</p>';
                echo '</span>';
            echo "</div>";
            }
            
            
                  
            
        
            
        //echo json_encode($comment);
            
        }
            
            
        }
        
    