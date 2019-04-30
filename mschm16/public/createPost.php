<?php include 'includes/top.php'; ?>

<h1>Create post</h1>

<?php 
$pname = $pText = $pImg = $postImageName = '';

$pNameErr = $pTextErr = $pImgErr = '';

$pUser = $_SESSION['userId'];

// Check if image file is a actual image or fake image
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["postName"])) {
        $pNameErr = "Your post needs a title.";
    } else {
        $pname = test_input($_POST["postName"]);
    }

    if (empty($_POST["postText"])) {
        $pTextErr = "Your post needs a description.";
    } else {
        $pText = test_input($_POST["postText"]);
    }

    $postImageName = basename( $_FILES["postImg"]["name"]);

    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["postImg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["postImg"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["postImg"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["postImg"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["postImg"]["name"]). " has been uploaded.";

            require_once 'includes/db.php';

                $sql = "INSERT INTO posts (postName, postImg, postText, fk_userId)
                        VALUES ('$pname', '$postImageName', '$pText', '$pUser')";

                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    /* Redirect */
                    header("Location: posts.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <span class="error"><?php echo $pNameErr;?></span>
    <input type="text" name="postName" id="pname" placeholder="Post title">

    <span class="error"><?php echo $pTextErr;?></span>
    <textarea name="postText" id='pText' placeholder="Describe your post here..."></textarea>

    <span class="error"><?php echo $pImgErr;?></span>
    <input type="file" name="postImg" id="pImg">

    <input type="submit" value="Create post">
</form>

<?php include 'includes/bot.php'; ?>