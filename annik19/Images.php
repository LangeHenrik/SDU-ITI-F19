<?php
session_start();
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="images.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<div id="navigation">
    <a href=Images.php>My Images</a>
    <?php if (isset($_SESSION['user'])) { ?>
        <a href=Login.php>Logout</a>
    <?php } else { ?>
        <a href=Login.php>Login</a>
    <?php } ?>
    <a href="Users.php">Community</a>
</div>

<div class="title">AEkόvεs</div>

<h1><div id="hello">Hello, <?php
        if (isset($_SESSION['user']))
            echo $_SESSION['user'];
        ?></div></h1>

<form action="upload.php" id="upload" method="post" enctype="multipart/form-data">
    <h1>Upload your image</h1>
    Give a title: <input name="img_title" type="text">
    <br> <br>
    Give a description:
    <br><br>
    <textarea name="img_text" rows="2" cols="100"></textarea>
    <br><br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br><br>
    <input type="submit" id="upload_button" value="Upload">
</form>

<div id="main">
    <?php
    if (isset($_SESSION['user'])) {
        // fetch user's images
        $user_data = 'SELECT * FROM' . ' user ' . 'INNER JOIN myimages on user.id = myimages.id_user WHERE username="'
            . $_SESSION['user'] . '";';
        $stmt = $conn->prepare($user_data);
        $stmt->execute();
    }
    ?>
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) { ?>
        <div class="images">
            <a target="_blank" href=  <?php print $row[13] ?>>
                <img class="img" src=  <?php print $row[13] ?>></a>
            <div class="header"><?php print $row[10] ?> <br> </div>
                <div class="description" >Your description:</div>
                <div class="text"><?php print $row[11] ?> </div>
                <form name="delete" method="post" action="delete.php">
                    <input type="hidden" name="image_path" value="<?php print($row[13])?>">
                    <button type='submit' value="Delete" class="delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>

        </div>
        <?php
    };
    ?>
</div>
</body>
</html>