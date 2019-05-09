<?php

    require "../app/models/ImageModel.php";
    require "../app/models/APIImageModel.php";

class GalleryService extends Database
{
    public function uploadImage($userId, $imageTitle, $imageDesc, $image) {

        $imageName = $image["name"];
        $imageType = $image["type"];
        $imageTempName = $image["tmp_name"];
        $imageError = $image["error"];
        $imageSize = $image["size"];


        $imageTempExt = explode(".", $imageName);
        $imageExt = strtolower(end($imageTempExt));

        $allowedTypes = array("jpg", "jpeg", "png");

        if (in_array($imageExt, $allowedTypes)) {
            if ($imageError === 0) {
                if ($imageSize < 5000000) {
                    $imageFullName = $imageTitle . "." . uniqid("", false) . "." . $imageExt;
                    $imageDestination = "../public/resources/gallery/" . $imageFullName;

                    if (empty($imageTitle) || empty($imageDesc)) {
                        //header("Location: ../index.php?upload=empty");
                        exit();
                    }
                    else {
                        $sql = "INSERT INTO gallery (idUsers, titleGallery, descGallery, imageNameGallery) VALUES (:userId, :titleGallery, :descGallery, :nameGallery);";
                        $statement = $this->conn->prepare($sql);

                        $statement->bindParam(":userId", $userId);
                        $statement->bindParam(":titleGallery", $imageTitle);
                        $statement->bindParam(":descGallery", $imageDesc);
                        $statement->bindParam(":nameGallery", $imageFullName);
                        //mysqli_stmt_bind_param($statement, "isss", $userId, $imageTitle, $imageDesc, $imageFullName);
                        $statement->execute();
                        //echo "hello";

                        echo $imageFullName, "      ",$imageTempName, "     ", $imageDestination;
                        //echo $imageDestination;
                        move_uploaded_file($imageTempName, $imageDestination);

                        //$imageUploadedId = $this->conn->lastInsertedId();
                        //return $imageUploadedId;

                    }
                }
                else {
                    echo "File size too big!";
                    exit();
                }
            }
            else {
                echo "You had " .$imageError. " error!";
                exit();
            }
        }
        else {
            echo "You need to upload a proper file type!";
            exit();
        }
    }

    public function deleteImage($imageName){
        $sql = "DELETE FROM gallery WHERE idGallery = :imageId;";
        $statement = $this->conn->prepare($sql);
        //mysqli_stmt_bind_param($statement, "s", $imageName);
        $statement->bindParam(":imageId", $imageName);

        $statement->execute();
        /*
        $image = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            return;
        }
        */
        if (file_exists("../public/resources/gallery/".$imageName)) {
            unlink("../public/resources/gallery/".$imageName);
        }

    }

    public function loadImages(){
        $postNewCount = 4;
        $sql = "SELECT * FROM gallery ORDER BY idGallery DESC LIMIT $postNewCount;";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $this->fillImage($statement);
    }

    public function loadImageFromUser($userId){
        $sql = "SELECT * FROM gallery WHERE idUsers = '$userId' ORDER BY idGallery DESC;";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $this->fillImage($statement);
    }

    private function fillImage($statement){
        $images = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $image = new ImageModel($row["idGallery"], $row["idUsers"], $row["titleGallery"], $row["descGallery"], $row["imageNameGallery"]);
            $images[] = $image;
        }
        return $images;
    }

}
