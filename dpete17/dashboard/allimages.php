<?php
    session_start();

    if(!isset($_SESSION['ID'])) {
        header('Location: /index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
    <link rel="stylesheet" href="../main-style.css">
    <link rel="stylesheet" href="dashboard-style.css">
    <script src="./../opinion-action.js"></script>
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Project A01</h1>
            <ul>
                <li><a href="account.php">Your Images</a></li>
                <li><a class="active" href="allimages.php">Uploaded Images</a></li>
                <li><a href="allaccounts.php">View All Accounts</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
            <?php 
                echo "<h4>{$_SESSION['username']}</h4>";
            ?>
        </header>
        <div class="dashboard-body">
            <hr>
            <div class="image-container">
                <?php

                include('../action/pdo.php');
                        
                try {
                    $sql = "SELECT (SELECT username FROM account, uploads WHERE account.id = uploads.account_id AND uploads.image_id = image.id) as username, image.id as image_id, image.filename, image.header, image.content,"
                    ."(SELECT COALESCE(sum(opinion = 'LIKES'), 0) FROM opinion WHERE image_id = image.id) as 'likes', "
                    ."(SELECT COALESCE(sum(opinion = 'DISLIKES'), 0) FROM opinion WHERE image_id = image.id) as 'dislikes' "
                    ."FROM image;";

                    $stmt = $conn -> prepare($sql);

                    $executed = $stmt -> execute();
                    $result = $stmt -> fetchAll();

                    $target_dir = '../uploads/';

                    foreach ($result as $row) {
                        $path = $target_dir . $row['filename'];
                        echo <<<EOL
                            <div>
                                <p>Created by: {$row['username']}</p>
                                <h2>{$row['header']}</h2>
                                <span>{$row['content']}</span>
                                <br>
                                <img src="{$path}" alt="Error.." >
                                <div class="opinions">
                                    <a href="#" onclick="onOpinion(this, 'LIKES')" data-id="{$row['image_id']}"><i class="fas fa-heart like"></i><p id="likes{$row['image_id']}">{$row['likes']}</p></a>
                                    <a href="#" onclick="onOpinion(this, 'DISLIKES')" data-id="{$row['image_id']}"><i class="fas fa-heart dislike"></i><p id="dislikes{$row['image_id']}">{$row['dislikes']}</p></a>
                                </div>
                            </div>
                            <hr>
                        EOL;
                    
                    }
                } catch (PDOException $e) {
                    $_SESSION['MESSAGE'] = "ERROR: " . $e -> getMessage();
                }

                ?>
            </div>
        </div>
        <?php include('../common/main-footer.php'); ?>
    </div>
</body>
</html>