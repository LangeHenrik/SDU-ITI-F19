<!DOCTYPE html>
<html>
    <body>
        <?php 
            include 'top.php'; 
            session_start();
            if ($_SESSION["logged_in"] == true) {
                $_SESSION["logged_in"] = false;
                echo '<div id="content" style="color: white"><br><br>You are logged out now. <br> You will be redirected to front page in a moment. <br><br> Please wait...</div>';
            } 
            session_destroy();
            header('Refresh: 1; url=index.php');
        ?>
    </body>
</html>