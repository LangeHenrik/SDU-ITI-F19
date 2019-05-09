<!DOCTYPE html>
<html>
    <head>
        <title>Registration Succeeded!</title>
        <?php 
            require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/top.php'; 
        ?>
    </head>
    <body>
        <div id="content">
            <br><br>
            <h1 style="color: green">Sign up succeeded</h1>
            <p>Well done! You followed the guidelines for user registration! <br><br><i>The page will redirect you back to home page in 3 seconds. Please wait!</i></p>
        </div>
        <!-- <?php
            header("Refresh: 3; url=/pepak16/mvc/public");
        ?> -->
    </body>
</html>
