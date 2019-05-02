<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 */

include '../app/views/partials/menu.php';
foreach($viewbag['pictures'] as $picture) :
    ?>

    <div style="background-color: lightblue;">
        <h2><?=$picture['title']?></h2>
        <p><?=$picture['description']?></p>
        <img src="<?=$picture['image']?>" alt="<?=$picture['title']?>" />
    </div>

<?php
endforeach;
include '../app/views/partials/foot.php';
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Verdana, sans-serif;
margin: 0;
    background-color: whitesmoke;
}

* {
    box-sizing: border-box;
}

.row > .column {
padding: 0 8px;
}

.row:after {
content: "";
display: table;
clear: both;
}

.column {
    float: left;
width: 25%;
}


.mySlides {
display: none;
}

.cursor {
cursor: pointer;
}

img {
    margin-bottom: -4px;
}


.demo {
opacity: 0.6;
}

img.hover-shadow {
transition: 0.3s;
}

.hover-shadow:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>

<body>

<h2 style="text-align:center">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> to picture supreme website! </h2>

<div class="row">

    <div class="column">
        <!--static picture for showing the user where to upload a picture. -->
        <img src="../../images/addbutton.png" style="width:100%" onclick="goToUploadPage()" class="hover-shadow cursor">
    </div>

    <!--Static pictures, so that there always is pictures -->
    <div class="column">
        <img src="picture/2.jpg" style="width:100%" class="hover-shadow cursor">
    </div>

    <!--Static pictures, so that there always is pictures -->
    <div class="column">
        <img src="picture/3.jpg" style="width:100%" class="hover-shadow cursor">
    </div>

    <!--Static pictures, so that there always is pictures -->
    <div class="column">
        <img src="picture/4.jpg" style="width:100%" class="hover-shadow cursor">
    </div>


</div>




<!-- Script for showcasing the pictures on clic, could be removed, as there is a error when browsing images.   -->
<script>
    function goToUploadPage() {
        document.location.href = 'upload.php';
    }


    var slideIndex = 1;
    showSlides(slideIndex);


    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }

</script>

</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

</head>
<body>

<?php
// Include the database configuration file
include 'configPicture.php';

// Get images from the database
// this is now the model and controller.
$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC LIMIT 20");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc() ){
        $imageURL = 'picture/'.$row["file_name"];
        ?>
        <div class="column">
            <img class="hover-shadow cursor" style="width:100%"  src="<?php echo $imageURL; ?>" alt="" />
        </div>
    <?php }

}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>

<p>
    <a href="resetPassword.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>

