<?php

require_once ("../Core/database.php");


class uploadModel extends Database {

    public function uploadPic($pictureTitle, $pictureText) {

        //Find the ID of the USER
        session_start();

        if (isset($_POST['submit'])) {

        $pictureTitle = ($_POST["filetitle"]);
        $pictureText = ($_POST["filedesc"]);
        //Fnd ID from the user
        //$user = $_SESSION["u_id"];
        $user = $_SESSION['u_id'];

        $queryUserID = 'SELECT user_id from ' . 'users' . ' where username="' . $user . '";';

        $stmt = $this->conn->prepare($queryUserID);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        //FileDic
        $fileDirectory = "uploads/";


        $fileHandled = $fileDirectory . basename($_FILES["file"]["name"]);



        //The tmp_name fpor temp dic
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileHandled)) {

            $picture = 'INSERT INTO pictures (title, description, userid, image) 
      VALUES (:title, :description, :userid, :image);';
            $stmt = $this->conn->prepare($picture);
            $stmt->bindParam(":title", $pictureTitle);
            $stmt->bindParam(":description", $pictureText);
            $stmt->bindParam(":userid", $user);
            $stmt->bindParam(":image", $fileHandled);
            $stmt->execute();
            header("Location: ../views/home/uploadView.php?`Success");
            ?>

          <?php } else {

            header("Location: ../views/home/uploadView.php?`Error");
        }
        header("Location: ../views/home/uploadView.php");
    }}
}
