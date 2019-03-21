<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    # Check login
    if(isset($_POST["logout"])) {
        header('location: index.php');
        session_destroy();
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        @$_SESSION['page_name'] = "Pictures";
    } else {
        echo "No user is currently logged in!";
        return;
    }

    include 'userLogin.php';

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        // $stmtGetPictures = $conn->prepare("SELECT picture_user_id, image_name, header, description FROM picture ORDER BY image_name DESC LIMIT 20");
        $stmtGetPictures = $conn->prepare("SELECT picture_user_id, image_name, header, description
            FROM (SELECT picture_user_id, image_name, header, description FROM picture ORDER BY image_name DESC LIMIT 20) sub ORDER BY image_name ASC");

        $stmtGetPictures->execute();
        $stmtGetPictures->setFetchMode(PDO::FETCH_ASSOC);
        $resultGetPictures = $stmtGetPictures->fetchAll();
        // print_r($resultGetPictures);


    } catch (PDOexception $e) {
        echo "Error: " . $e->getMessage();
    }

    # Close db connection
    $conn = null;

?>

<html>
    <head>
        <title>Assignment 1</title>
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div class="block-pictures">
            <?php
                foreach ($resultGetPictures as $picture) {
                    echo "<div class='picture'>";
                        $pictureUserId = $picture['picture_user_id'];
                        $imageName = $picture['image_name'];
                        $header = $picture['header'];
                        $description = $picture['description'];

                        $imageNameExploded = explode ('-', $imageName);
                        $date = date('d-m-Y H:i', current($imageNameExploded));

                        foreach ($resultGetUsers as $user) {
                            if ($user["picture_user_id"] === $pictureUserId) {
                                $pictureAuthor = $user["firstname"] . " " . $user["lastname"];
                            }
                        }

                        echo "<p class='header'>$header</p>";
                        echo "<img src='uploads/$imageName'>";
                        echo "<p class='description'>$description (User: $pictureAuthor)</p>";
                        // echo "<p class='date'>date('d-m-Y', $date)</p>";
                        echo "<p class='date'>Uploaded: $date</p>";
                        echo "<hr>";
                    echo "</div>";
                }
            ?>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
