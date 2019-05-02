<?php


echo "<h1>Users:</h1>";

foreach ($viewbag as $user){
     
    echo "<div id=user_feed>";
         echo "<p> ".htmlentities($user->user_name)." </p>";
        echo "</div>";
    
    
}

