
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
        <img src="addbutton.png" style="width:100%" onclick="goToUploadPage()" class="hover-shadow cursor">
    </div>

    <!--Static pictures, so that there always is pictures -->
    <div class="column">
        <img src="picture/2.jpg" style="width:100%" class="hover-shadow cursor">
    </div>

    <div class="column">
        <img src="picture/3.jpg" style="width:100%" class="hover-shadow cursor">
    </div>

    <div class="column">
        <img src="picture/4.jpg" style="width:100%" class="hover-shadow cursor">
    </div>


</div>





<script>
    function goToUploadPage() {
        document.location.href = '/mmare15/mvc/public/upload/';
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

<?php if (isset($viewbag["pictures"])) {
    $latestimages = $viewbag["pictures"];
    for ($item = 0; $item <= sizeof($latestimages) - 1; $item++) {
        echo '<div class="boxyInside">';
        echo '<h2>' . $latestimages[$item]['title'] . '</h2>';
        echo '<h5>' . 'Submitted by: ' . $latestimages[$item]['username'] . '</h5>';
        echo '<div class="resize">';
        echo '<img src="' . $latestimages[$item]['imageString'] . '" />';
        echo '</div>';
        echo '<h4>' . 'Description:' . '</h4>' . $latestimages[$item]['description'];
        echo '</div>';
    }
} ?>

<p>
    <a href="resetPassword.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>
