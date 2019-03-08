<?php
session_start();
require 'database.php';
$statusMsg = '';

// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(isset($_SESSION['user_id'])) {
    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $sql = "INSERT INTO images (owner, file_name) VALUES (:owner, :file_name)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':owner', $_SESSION['user_id']);
                $stmt->bindParam(':file_name', $fileName);
                $insert = $stmt->execute();
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again." . $insert;
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
} else {
    $statusMsg = 'Please login.';
}
// Display status message
echo $statusMsg . "<br/> UserId: " .$_SESSION['user_id'];
?>