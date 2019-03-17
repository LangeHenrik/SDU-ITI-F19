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
        </header>
        <div class="dashboard-body">
            <hr>
            <div class="image-container">
                <?php

                include('../action/pdo.php');
                        
                try {
                    $sql = 'SELECT account.username, image.filename, image.header, image.content FROM account, image, uploads WHERE account.id = uploads.account_id AND image.id = uploads.image_id LIMIT 20;';
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bindParam(':id', $_SESSION['ID']);

                    $executed = $stmt -> execute();
                    $result = $stmt -> fetchAll();

                    $target_dir = '../uploads/';

                    foreach ($result as $row) {
                        $path = $target_dir . $row['filename'];
                        echo "<div><p>Created by: {$row['username']}</p><h2>{$row['header']}</h2><span>{$row['content']}</span><br><img src=\"{$path}\" alt=\"Error..\" ></div>";
                        echo '<hr>';
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