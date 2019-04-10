<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../CSS/PictureManagement.css">
    <link rel="stylesheet" type="text/css" href="../CSS/General.css">
    <script src="../JS/PictureManagement.js"></script>
    <script src="../JS/navbar.js"></script>

    <meta charset="UTF-8">
    <title>My Images</title>
</head>
<body>

    <?php

    if (isset($_SESSION["username"])) {
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Profile</a></navbar>";
    } else {
        echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Register</a></navbar>";
    }

    ?>
    <?php

    include 'imageLoader.php';
    if (isset($_SESSION["username"])) {

        $firstLogin = (int)$_SESSION['first_login'];

        $btnUploadClass = '';
        if($firstLogin != 1) {
            $btnUploadClass = 'btn-upload-pulse';
        } else {
            $btnUploadClass = 'btn-upload-no-pulse';
        }

        $imageElements = loadUsersImages();
        echo " 
        <div class='page-container'>
        <div class=\"main-content\" id=\"main-content-feed\">
                <h1 class=\"feed-title\">Welcome {$_SESSION['username']}!</h1>
                <div class='scroll-content'>
                    <div class=\"top-content\">
                   
                        <div id=\"new-image-input-container\">
                    
                            <div id=\"new-image-input-form-container\">
                                   <form id='submit-image-form' action='UploadImage.php' method='post' enctype=\"multipart/form-data\">
                        
                                        <input maxlength='30' type=\"text\" name='imageHeader' id=\"txtInputHeader\" placeholder=\"Image name....\">
                                        <div id='desc-preview-container'>
                                            <textarea maxlength='100' id=\"textarea-image-description\" name='imageText' rows=\"10\" placeholder=\"Description of image...\"></textarea>
                                            <img id='preview' src='#'/>
                                        </div>
                                        <input type=\"submit\" id='btn-submit-image' value=\"Upload Image\" name=\"submit\" disabled>
                            
                            
                                    </form>
                            </div>
                        </div>
                    
                    
                </div>
                <div id=\"user-images-container\" class=\"image-feed-container\">
                    {$imageElements}
                </div>
            </div>
           
    
        <button id=\"{$btnUploadClass}\" >Upload</button>
    </div>
    </div>";

    } else {
        echo "
            <div class=\"loginform\">
                <h2>Login to your account</h2>
                <form action=\"LogIn.php\" method='post'>
                    <input type=\"text\" name=\"username\" placeholder=\"username\"/>
                    <input type=\"password\" name=\"password\" placeholder=\"password\"/>
                    <button type=\"submit\" class=\"btn\" id=\"btnLogin\">Login</button>
                    <a class=\"btnCreateNewUser\"
                       id=\"btnSubmit\"
                       href=\"LoginPage.php\">Create new user</a>
                </form>
            </div>";
    };

    ?>
</body>
</html>