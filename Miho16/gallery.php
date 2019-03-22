<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 21-03-2019
 * Time: 01:06
 */
session_start();
echo"welcome to the gallery " .$_SESSION['username'];

require 'DB_manager.php';
$result = gallerydb();
//$data = $result[0]["image"];


for($item = 0; $item <= sizeof($result)-1; $item++) {
    echo '<div class="boxyInside">';
    echo '<h2>' . $result[$item]['title'] . '</h2>';
    echo '<h5>' . 'Submitted by: ' . $result[$item]['username'] . '</h5>';
    echo '<div class="resize">';
    echo '<img src="' . $result[$item]['image'] . '"/>';
    echo '</div>';
    echo '<h4>' . 'Description:' . '</h4>' . $result[$item]['description'];
    echo '</div>';
}




if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    header('location: startpage.php');
}

?>


<html>
    <head>
        <title> Gallery </title>
        </head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <body>
        <form method = "post" name = "logout">
            <input type = "submit" name = "logout" value="logout" >
        </form>
        <form  name = "upload" action="upload_image.php">
            <input type = "submit" name = "upload" value="upload" >
        </form>



    <button><a id="button">Show all users</a></button>

    <p id="container"><!-- currently it's empty --></p>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a#button').click(function(){
                $.ajax({
                    url: 'userlist.php',
                    success: function (response) {
                        $('#container').html(response);
                    }
                });
            });
        });
    </script>
    </body>

</html>



