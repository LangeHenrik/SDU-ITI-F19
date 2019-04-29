<?php

require 'dbh.inc.php';
 
    $id = $_POST['id'];
    echo $id;


if(deleteFromFolder($conn, $id)){
    if(deleteFromDB($conn, $id)){
        header("Location: ../Dankify_my_images?delete=successful");
    }
}


function deleteFromDB($conn, $id){
    
    $query = "DELETE FROM images WHERE img_id=?";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "d", $id);
        mysqli_stmt_execute($stmt);
        return true;
    
    
}
}



function deleteFromFolder($conn, $id){
    
    $query = "SELECT * FROM images WHERE img_id=?";
    $stmt = mysqli_stmt_init($conn);  
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "There was a unexpected error.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "d", $id);
         mysqli_stmt_execute($stmt);
     
        $result = mysqli_stmt_get_result($stmt);
        
        
        if($row = mysqli_fetch_array($result)){
           
             $path ="Uploads/".$row['name']."";
             if(!unlink($path)){
                echo "There was a problem in deleting the file from the folder."; 
             } else {
                 return true;
             }   
    }
}
    
    
}
    

    
    
    
  
