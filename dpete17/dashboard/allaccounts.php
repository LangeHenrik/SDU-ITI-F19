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
                <li><a href="allimages.php">Uploaded Images</a></li>
                <li><a class="active" href="allaccounts.php">View All Accounts</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
        </header>
        <div class="dashboard-body">
            <?php

                include('../action/pdo.php');
                        
                try {
                    $sql = 'SELECT username FROM account LIMIT 1000';
                    $stmt = $conn -> prepare($sql);

                    $executed = $stmt -> execute();
                    $result = $stmt -> fetchAll();

                    for ($i=0; $i < count($result); $i++) {
                        $current = $i + 1;
                        echo "<div>{$current}. <span>{$result[$i]['username']}</span></div>";
                    }
                } catch (PDOException $e) {
                    echo "ERROR: " . $e -> getMessage();
                }

            ?>
        </div>
        <?php include('../common/main-footer.php'); ?>
    </div>
</body>
</html>