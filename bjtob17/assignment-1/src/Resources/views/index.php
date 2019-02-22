<?php
use Services\Auth;
require "partials/MenuPartial.php";
require "partials/PhotoPartial.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/Resources/css/style.css">
    <title>Title | <?php echo $viewData["_app_title"] ?></title>
</head>
<body>
<div class="wrapper">
    <header class="main-head">
        <div class="left">
            <h1><?php echo $viewData["_app_title"]; ?></h1>
        </div>
        <div class="right">
            <div id="weather">
                <div class="top">
                    <div id="city"></div>
                    <div>
                        <img id="icon" src="#" alt="">
                    </div>
                    <p id="description"></p>
                </div>
                <div class="bottom">
                    <div id="temp">
                        <span id="value"></span>
                        <span id="unit"></span>
                    </div>
                    <div id="up-container"><span id="up"></span>
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div id="down-container"><span id="down"></span>
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <nav class="main-nav">
        <?php MenuPartial::show(); ?>
    </nav>
    <article>
        <div class="user-photos cards">
            <?php

            foreach ($viewData["photos"] as $photo) {
                PhotoPartial::show($photo);
            }


            ?>
        </div>
    </article>
    <footer class="main-footer">The footer</footer>
</div>

<script src="/Resources/js/js.js"></script>
</body>
</html>