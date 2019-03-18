<?php
  require "header.php";
  include "includes/dbh.php";
 ?>

 <main>
   <script type="text/javascript">
   let piccount = 20;
   window.onscroll = function(){
     if ((document.documentElement.scrollTop+window.innerHeight)=== document.documentElement.offsetHeight) {
       //alert("ajax has run");
       loadDoc();
     }}

   function loadDoc() {
     piccount = piccount +20;
     let display = document.getElementById("ajax");
           let xmlhttp = new XMLHttpRequest();
           xmlhttp.open("GET", "load_pictures.php?pictureCount="+piccount);
           //xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           xmlhttp.send();
           xmlhttp.onreadystatechange = function() {
             if (this.readyState === 4 && this.status === 200) {
               display.innerHTML = this.responseText;
             } else {
               display.innerHTML = "Loading...";
             };
           }
}

   </script>
   <?php
   if (isset($_SESSION['userid'])) {
     echo '<div id="ajax" class="">';


           $stmt = $conn -> prepare("SELECT * from pictures order by idpic desc limit 20 ");
           $stmt -> execute();
           if ($stmt->rowCount() > 0) {
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               echo '<div class = "image">';
               echo '<p>'.$row['username'];
               echo '<br>';
               echo '<img class="images" src="'.$row['path'].'" alt="'.$row['name'].'">';
               echo '</div>';
             }
           }


     echo '</div> ';
   }
   else {
     echo '<p class="login-status">You are corrently not logged in and can there for not se any files</p>';
   }
    ?>

 </main>

 <?php

  ?>
