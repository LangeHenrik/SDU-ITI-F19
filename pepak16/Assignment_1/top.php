<link rel="stylesheet" type="text/css" href="style.css">
<?php include 'ViewController.php'; ?>
<script src="ajax.js"></script>
<div id="headertitle"><h1>Photoshare</h1></div>
<ul>
    <li><a href="index.php">Home</a></li>
    <?php 
        session_start();

        if ($_SESSION["logged_in"] == true) {
            
            echo "<li><a href=\"logout.php\">Logout</a></li>";
            echo "<li><input type=\"text\" name=\"search\" id=\"search\" onkeyup=\"showHint(this.value)\" placeholder=\"Search\"></li>";
            // echo "<li><p>You are logged in as:".$_SESSION["logged_in"]."</p></li>";
            
        } else {
            echo "<li><a href=\"login_page.php\">Login</a></li>";
            echo "<li><a href=\"register_page.php\">Signup</a></li>";
        }
      
    ?>
</ul>