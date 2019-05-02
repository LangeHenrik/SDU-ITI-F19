<?php include '../app/views/partials/header.php';


?>

<div class="contentUpload">
    <form class="upload" action="/peten17/mvc/public/Picture/uploadPicture" method="post" enctype="multipart/form-data">
       <input type="hidden" name="size" value="1000000">
       <div>
         <label for="pictureTitle">Title:</label><br>
         <input type="text" name="pictureTitle">
       </div>
       <div>
         <label for="pictureDesc">Description:</label> <br>
         <textarea name="pictureDesc" rows="3" cols="40" placeholder="Say something about this image..."></textarea>
       </div>
       <div>
         <input type="file" name="pictureFile">
         <br><br>
       </div>
       <div>
         <input type="submit" name="upload" value="Upload Image">
       </div>
     </form>
    </div>
<?php

    include '../app/views/partials/foot.php';


    
