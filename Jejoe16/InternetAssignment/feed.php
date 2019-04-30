<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 15-03-2019
 * Time: 09:15
 */

include("database.php");

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'true' :
            toggleLike($_POST['image']);
            echo("<script>console.log('PHP: ".$_POST['image']."');</script>");
            break;
        case 'false' : break;
        // ...etc...
    }
}

?>
<html lang="en">
<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>images</title>

    <script>
        function myFunction(x,image) {
            x.classList.toggle("fa-thumbs-down");
            $.ajax({ url: 'feed.php',
                data: {action: 'true', image: image},
                type: 'post',
                success: function(output) {
                }
            });

        }
    </script>

</head>
<body>

<h1>Uploads</h1>
<?php


$feeds = getallimages();
for ($x = sizeof($feeds) -1; $x >= 0; $x--) {

    echo '<div class="containerInside">';
    echo '<h1>Image Title</h1>';
    echo '<h3>'.$feeds[$x]['headertext'].'</h3>';
    $imagep = $feeds[$x]['imagepath'];
    $a = '\'';
    $imagep = $a.$imagep.$a;

    echo '<img src="'.$feeds[$x]['imagepath'].'"/>';
    echo '<h1>Image Comment</h1>';
    echo '<h3>'.$feeds[$x]['imagetext'].'</h3>';
    echo '<i id="'.$imagep.'" onclick="myFunction(this,'.$imagep.')" class="fa fa-thumbs-up" style="font-size:48px"></i>';
    if($feeds[$x]['likeS'] == 0){
        echo '<script>document.getElementById("'.$imagep.'").classList.toggle("fa-thumbs-down");</script>';
    }
    echo '</div>';
}


?>

</body>


</html>