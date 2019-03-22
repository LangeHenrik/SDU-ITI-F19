<?php
    session_start()
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description. THis will often show up in search results.">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="resources/style.css">
        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function() {
                var postCount = 4;
                $("#loadbtn").click(function() {
                    postCount = postCount + 4;
                    $("#posts").load("load-posts.php", {
                        postNewCount: postCount
                    });
                });
            });
        </script>


    </head>
    <body>

        <header>
            <nav>
                <div class="header">
                <a href="#">
                    <img src="resources/Samstagram.PNG" alt="logo">
                </a>
                </div>

                <div class="topnav">
                    <a href="index.php">Gallery</a>
                    <a href="portfolio.php">My Portfolio</a>
                    <a href="users.php">Users</a>

                    <?php
                        if (isset($_SESSION['userId'])) {
                            $username = $_SESSION['userUid'];


                            echo '<div class="login-container">
                                <form action="resources/logout.res.php" method="post">
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>
                            </div>';
                            echo '<div class="login-container">
                                    <button '.$username.'>'.$username.'</button>
                            </div>';
                        }
                        else {
                            echo '<div class="login-container">
                        <form action="resources/login.res.php" method="post">
                            <input type="text" name="mailuid" placeholder="Username/E-mail...">
                            <input type="password" name="pwd" placeholder="Password...">
                            <button type="submit" name="login-submit">Login</button>
                        </form>
                    </div>

                    <div class="login-container">
                        <a href="signup.php">Signup</a>
                    </div>';
                        }
                    ?>

                </div>

            </nav>
        </header>