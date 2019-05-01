<div class="content">
    <form class="upload" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
       <input type="hidden" name="size" value="1000000">
       <div>
         <input type="file" name="file">
         <br><br>
       </div>
       <div>
         <textarea name="comment" rows="3" cols="40" placeholder="Say something about this image..."></textarea>
       </div>
       <div>
         <input type="submit" name="upload" value="Upload Image">
       </div>
     </form>
    </div>
    
