<ul>
    <li><a href="?option=home">Home</a></li>
    <?php 
        // $_SESSION["logged_in"] = false;
        if ($_SESSION["logged_in"] == true) {
            echo "<li><a href=\"?option=searchPage\">Search</a></li>";
            echo "<li><a href=\"?option=showAllUsers\">Show all users</a></li>";
            echo "<li><a style=\"color: red\" href=\"?option=logout\">Logout</a></li>";
            //if ($_SESSION["disable_searchbar"] == false) {
            //echo "<li><input type=\"text\" name=\"search\" id=\"search\" onkeyup=\"showHint(this.value)\" placeholder=\"Search for a picture\"></li>";
            //}
            // echo "<li><p>You are logged in as:".$_SESSION["logged_in"]."</p></li>";
            echo '<li><p>&nbsp;&nbsp;Hello <b>'.$_SESSION["username"].'</b>! You\'re now logged in</p></li>';
        } else {
            echo "<li><a href=\"?option=login\">Login</a></li>";
            echo "<li><a href=\"?option=register\">Signup</a></li>";
        }

        
    ?>
</ul>