<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description. THis will often show up in search results.">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="/sabah15/mvc/public/resources/style.css">
        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous">
        </script>


        <!--<script>
            $(document).ready(function() {
                var postCount = 4;
                $("#loadbtn").click(function() {
                    postCount = postCount + 4;
                    $("#posts").load("/sabah15/mvc/public/home/loadMoreImages/", {
                        postNewCount: postCount
                    });
                });
            });
        </script>-->


    </head>
    <body>

        <header>
            <nav>
                <div class="header">
                <a href="#">
                    <img src="/sabah15/mvc/public/resources/Samstagram.PNG" alt="logo">
                </a>
                </div>

                <div class="topnav">
                    <a href="/sabah15/mvc/public/home/">Gallery</a>
                    <a href="/sabah15/mvc/public/home/portfolio/">My Portfolio</a>
                    <a href="/sabah15/mvc/public/home/users">Users</a>

                    <?php
                        if (isset($_SESSION['userId'])) {
                            $username = $_SESSION['userUid'];


                            echo '<div class="login-container">
                                <form action="/sabah15/mvc/public/home/logout" method="post">
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>
                            </div>';
                            echo '<div class="login-container">
                                    <button '.$username.'>'.$username.'</button>
                            </div>';
                        }
                        else {
                            echo '<div class="login-container">
                        <form action="/sabah15/mvc/public/home/login" method="post">
                            <input type="text" name="mailuid" placeholder="Username/E-mail...">
                            <input type="password" name="pwd" placeholder="Password...">
                            <button type="submit" name="login-submit">Login</button>
                        </form>
                    </div>

                    <div class="login-container">
                        <a href="/sabah15/mvc/public/home/signup">Signup</a>
                    </div>';
                        }
                    ?>

                </div>

            </nav>
        </header>