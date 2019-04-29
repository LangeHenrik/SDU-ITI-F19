<?php

class Images extends Database {
    private $preparedGetImages;
    private $preparedGetInitialImages;
    private $stmtUploadImage;

    public function __construct(){
        parent::__construct();
        $this->preparedGetImages=$this->conn->prepare('SELECT * FROM media order by id desc LIMIT :offset,4');
        $this->preparedGetInitialImages=$this->conn->prepare("SELECT * FROM media order by id desc limit 20");
        $this->stmtUploadImage = $this->conn->prepare("INSERT INTO media (uploaded_by, media_name, title, description) VALUES (:userID, :imageName, :title, :description)");
    }

    public function loadInitialImages(){
        $this->preparedGetInitialImages->execute();
        $this->preparedGetInitialImages->setFetchMode(PDO::FETCH_ASSOC);
        $payload=$this->preparedGetInitialImages->fetchAll();
        return $payload;
    }

    public function getimages(){
        if(isset($_GET["offset"])){
            if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
        
                $preparedGetImages->bindParam(':offset',$_GET["offset"],PDO::PARAM_INT);
                $preparedGetImages->execute();
                $preparedGetImages->setFetchMode(PDO::FETCH_ASSOC);
                $result=$preparedGetImages->fetchAll();
                $preparedGetImages=null;
                
                $columns=array();
                
                if(sizeof($result)==0){
                    echo '0';
                }else{
                    foreach($result as $row){
                        $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="media/'.$row['media_name'].'"><p>'.$row['description'].'</p></div>';
                        array_push($columns,$tmp);
                    }
                    echo json_encode($columns);
                }  
            }
        }
    }

    public function uploadImage(){
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
                $respons = $respons . "Ublæret filtype! Kun .jpeg, .jpg and .png filer er tilladt<br>";
            }
            if ($fileSize > 1000000) {
                $respons = $respons . "Filen er lidt for blæret til os! Vælg en mindre blæret fil.<br>";
            }
            if ($respons === "") {
                $uploadFileName = time() . "-" . $fileName;
                # Upload file
                move_uploaded_file($fileTmp, "media/" . $uploadFileName);
                $inputHeader = htmlentities(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
                $inputDescription = htmlentities(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));
        
                $stmtUploadImage->bindparam(':userID', $_SESSION['loggedInUser']);
                $stmtUploadImage->bindparam(':imageName', $uploadFileName);
                $stmtUploadImage->bindparam(':title', $inputHeader);
                $stmtUploadImage->bindparam(':description', $inputDescription);
                $stmtUploadImage->execute();
        
                $respons =  "File uploaded!";
            }
            return $respons;
        }
    }
}