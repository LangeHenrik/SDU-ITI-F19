<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 15-03-2019
 * Time: 09:15
 */

?>
<html lang="en">
<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <title>images</title>
</head>
<body>

<h1>Uploads</h1>
<?php
include("database.php");

$feeds = getallimages();
for ($x = sizeof($feeds) -1; $x >= 0; $x--) {

    echo '<div class="containerInside">';
    echo '<h1>Image Title</h1>';
    echo '<h3>'.$feeds[$x]['headertext'].'</h3>';
    echo '<img src="'.$feeds[$x]['imagepath'].'"/>';
    echo '<h1>Image Comment</h1>';
    echo '<h3>'.$feeds[$x]['imagetext'].'</h3>';
    echo '</div>';
}


?>

</body>


</html>