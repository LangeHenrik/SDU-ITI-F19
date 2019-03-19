<?php
  require "header.php";
  include "includes/dbh.php";
 ?>

 <main>
  
   <?php
   if (isset($_SESSION['userid'])) {
     $stmt = $conn -> prepare("SELECT * from pictures where name = :name ");
     $stmt-> bindParam(':name', $_GET['path']);
     $stmt -> execute();
     if ($stmt->rowCount() > 0) {
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       $GLOBALS['picid']=$row['idpic'];
         echo '<div class = "single">';
         echo '<p>'.$row['username'];
         echo '<br>';
         echo '<img class="single_im" src="'.$row['path'].'" alt="'.$row['name'].'">';
         echo '</div>';
       }
     echo '<div id="ajax" class="">';
     $stmt = $conn -> prepare("SELECT * from comments where picid = :name ");
     $stmt-> bindParam(':name', $GLOBALS['picid'] );
     $stmt -> execute();
     if ($stmt->rowCount() > 0) {
       while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         echo '<br><div class = "comment">';
         echo '<p>'.$row['username'];
         echo '<br>';
         echo '<p class = "com">'.$row['usercomment'].'</p1>';
         echo '</div>';
       }}

     echo '</div> <div class="newcomment">';
     echo '<p>Comment</p>
     <form id = "usrform" action ="includes/upload_comment.inc.php?name='.$_GET['path'].'&id='.$GLOBALS['picid'].' " method = "post">
     <textarea rows="4" cols="50" name="comment"></textarea>
     <button type="submit" name="comment_submit">Post</button>
     </form>';

     echo '</div>';
   }
   else {
     echo '<p class="login-status">You are corrently not logged in and can there for not se any files</p>';
   }
    ?>

 </main>

 <?php

  ?>
