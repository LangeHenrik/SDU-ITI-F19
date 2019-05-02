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
    

</head>     
    
<body>
    
<!--
Form that creates an upload button for the website along sending the form to the upload.inc.php file on a successful upload.
-->    

 <main>
     <section class = "section-default">
     
    <?php
         
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
         
    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];
        
        echo "<p>You are logged in as ".htmlentities($user_name)."</p>";
        echo '<form action="includes\upload.inc.php" method="POST" enctype="multipart/form-data">
        
    <label for="image_description">Enter a description</label>    
    <textarea rows = "5" cols = "50" name = "description"> 
    </textarea>
    
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="upload">
    </form>';
    
refreshImages($user_name, $conn);
        
        
    } else {
        echo '<p>You are NOT logged in</p>';
    }        
    
         
    function refreshImages ($user_name, $conn) {      
    $query = "SELECT * FROM images WHERE user_name=?";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user_name);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
    }
   
    while($row = mysqli_fetch_array($result)){
        echo "<div id=image_feed>";
        echo '<p class="upload_section">'.htmlentities($row['user_name']).' uploaded:</p>';
        echo "<img src='includes/Uploads/".htmlentities($row['name'])."' >";
        echo "<h1>Description:</h1>";
        echo "<p class=description>".$row['description']."</p>"; 
        echo "</div>";
        //echo "<a href='includes/delete_image.inc.php?id=".htmlentities($row['img_id'])."'>Delete image</a>";
        echo '<p id="serverResponse"></p>';
        echo '<button onclick="deleteImage('.$row['img_id'].')">Delete image</button>';
    
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
        
}
         
    ?>
    
         
         
     </section>
     
</main>
   <script type="text/javascript">
         function deleteImage(id){
        var deleteRequest = new XMLHttpRequest();
        deleteRequest.onload = function(){
           
            location.reload();
            /*var deleteReponse = document.getElementById("serverResponse");
            deleteReponse.innerHTML = "Hello m8";
            deleteReponse.innerHTML = this.responseText;*/
        //"The image with the name of"+name+"was deleted";
        };
        
        deleteRequest.open("POST", "includes/delete_image.inc.php");
        deleteRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        deleteRequest.send("id="+id);
         }
    </script>    
</body>
</html>