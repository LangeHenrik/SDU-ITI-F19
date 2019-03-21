<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    # Check login
    if (isset($_POST["logout"])) {
        header('location: index.php');
        session_destroy();
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        @$_SESSION['page_name'] = "Header";
    } else {
        echo "No user is currently logged in!";
        return;
    }

    include 'userLogin.php';

    if (isset($_FILES['image-upload'])) {
        $respons = "";
        $fileName = $_FILES['image-upload']['name'];
        $fileSize = $_FILES['image-upload']['size'];
        $fileTmp = $_FILES['image-upload']['tmp_name'];
        $fileType = $_FILES['image-upload']['type'];

        $fileNameExploded = explode ('.', $_FILES['image-upload']['name']);
        $fileExt = strtolower(end($fileNameExploded));

        $validExtensions = array("jpeg", "jpg", "png");

        if (in_array($fileExt, $validExtensions) === false) {
            $respons = $respons . "Invalid extension! Only .jpeg, .jpg and .png files allowed<br>";
        }

        if ($fileSize > 1000000) {
            $respons = $respons . "The file is too large!<br>";
        }

        if ($respons === "") {
            $uploadFileName = time() . "-" . $fileName;
            # Upload file
            move_uploaded_file($fileTmp, "uploads/" . $uploadFileName);

    		$inputHeader = htmlentities(filter_input(INPUT_POST, "header", FILTER_SANITIZE_STRING));
    		$inputDescription = htmlentities(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));

            # establish db connection
            require_once 'db_config.php';

            try {

                $conn = new PDO("mysql:host=$servername;dbname=$dbname",
                $username,
                $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                
                $stmtUploadImage = $conn->prepare("INSERT INTO picture (picture_user_id, image_name, header, description) VALUES (:userID, :imageName, :header, :description)");
				$stmtUploadImage->bindparam(':userID', $userId);
                $stmtUploadImage->bindparam(':imageName', $uploadFileName);
                $stmtUploadImage->bindparam(':header', $inputHeader);
                $stmtUploadImage->bindparam(':description', $inputDescription);

                $stmtUploadImage->execute();

            } catch (PDOexception $e) {
                echo "Error: " . $e->getMessage();
            }

            # Close db connection
            $conn = null;

            $respons =  "File uploaded!";
        }
    }

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

        <form class="form-upload" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload</legend>
                <p>Title</p>
                <input type="text" name="header"><br><br>
                <p>Description</p>
                <textarea name="description" rows="5" cols="40"></textarea><br><br>
                <input type="file" name="image-upload"><br><br>
                <button type="btn-upload">Upload</button>
            </fieldset>
        </form>

        <?php
            if(isset($respons)) {
                echo "<p class='error-response'> $respons</p>";
            }
         ?>

        <?php include 'footer.php'; ?>
    </body>
</html>
