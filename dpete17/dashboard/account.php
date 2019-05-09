<?php
    session_start();

    if(!isset($_SESSION['ID'])) {
        header('Location: /index.php');
    } else {
        include('../action/pdo.php');

        try {
            # username
            $sql = 'SELECT username FROM account WHERE id = :id;';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':id', $_SESSION['ID']);
            $executed = $stmt -> execute();
    
            $result = $stmt -> fetchAll();
    
            $_SESSION['username'] = $result[0]['username'];
    
            # images
            $sql = 'SELECT filename, header, content FROM image WHERE id IN(SELECT image_id FROM uploads WHERE account_id = :id) LIMIT 20;';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':id', $_SESSION['ID']);
    
            $executed = $stmt -> execute();
            $result = $stmt -> fetchAll();
        } catch (PDOException $e) {
            $_SESSION['MESSAGE'] = "ERROR: " . $e -> getMessage();
        }
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
                <li><a class="active" href="account.php">Your Images</a></li>
                <li><a href="allimages.php">Uploaded Images</a></li>
                <li><a href="allaccounts.php">View All Accounts</a></li>
                <li><a href="../action/logout.php">Logout</a></li>
            </ul>
            <?php 
                echo "<h4>{$_SESSION['username']}</h4>";
            ?>
        </header>
        <div class="dashboard-body">
            <form action="../action/imageupload.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Title" name="header" id="upload-header" required>
                <br>
                <textarea name="content" placeholder="Content" cols="30" rows="10" id="upload-content" disable></textarea>
                <br>
                <input type="file" name="image" required>
                <button type="submit">Submit Picture!</button>
            </form>
            <hr>
            <div class="image-container">
                <?php
                
                    $target_dir = '../uploads/';

                    foreach ($result as $row) {
                        $path = $target_dir . $row['filename'];
                        echo "<div><h2>{$row['header']}</h2><span>{$row['content']}</span><br><img src=\"{$path}\" alt=\"Error..\" ></div>";
                        echo '<hr>';
                    }

                ?>
            </div>
        </div>
        <?php include('../common/main-footer.php'); ?>
    </div>
</body>
</html>