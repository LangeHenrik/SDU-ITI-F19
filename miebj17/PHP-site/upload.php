<?php
require_once "config.php";
if (isset($_POST['submit'])) {

    $text = $_POST['text'];
    $header = $_POST['header'];

    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if($fileSize < 100000) {
                // Checks and see if the file with the same name already exists, so that it doesn't replace the old file.
                $fileNameNew = uniqid('', true). ".".$fileActualExt;
                //Chooses the folder
                $fileDestination = 'upload/' .$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "INSERT INTO upload_image (path, text, header) VALUES (?,?,?)";
                if($stmt = mysqli_prepare($link, $sql)){
                  // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sss", $param_path, $param_text, $param_header);
    
                    // Set parameters
                    $param_path = $fileDestination;
                    $param_text = $text;
                    $param_header = $header;
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                            
                        header("Location: welcome.php?uploadsuccess");
                        
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }else{echo "shit";}

                // Close statement
                mysqli_stmt_close($stmt);


                // Close connection
                mysqli_close($link);

            } else {
                echo "Your file is too big ;)!";
            }
        } else {
            echo "Error uploading you file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}

        $db = $link;
        if($db->connect_error){
            die("Unable to connect database: " . $db->connect_error);
        }
        $query = $db->query("SELECT * FROM upload_image;");
        if($query->num_rows > 0){

            $count = $query->num_rows;


            if ($count >= 20) {
                $result = $query;
                for ($i=0; $i < 20; $i++) {
                $row = $query -> fetch_assoc();
                    
                echo "<div id='img_div'>";
                    echo "<h3>".$row['upload_image_header']."</h3>";
                    echo "<img src='upload/".$row['upload_image_path']."'>";
                    echo "<p>".$row['upload_image_text']."</p>";
                echo "</div>";
                }
            } else {
                while ($row = $query -> fetch_assoc()) {
                    echo "<div id='img_div'>";
                    echo "<h3>".$row['header']."</h3>";
                    echo "<img src='".$row['path']."'>";
                    echo "<p>".$row['text']."</p>";
                    echo "</div>";
                }
            }
        }

?>
