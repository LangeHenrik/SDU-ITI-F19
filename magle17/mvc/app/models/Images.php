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
            if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        
                $this->preparedGetImages->bindParam(':offset',$_GET["offset"],PDO::PARAM_INT);
                $this->preparedGetImages->execute();
                $this->preparedGetImages->setFetchMode(PDO::FETCH_ASSOC);
                $result=$this->preparedGetImages->fetchAll();
                $this->preparedGetImages=null;
                
                $columns=array();
                
                if(sizeof($result)==0){
                    echo '0';
                }else{
                    foreach($result as $row){
                        $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="data:image/;base64,'.$row['media_name'].'"><p>'.$row['description'].'</p></div>';
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
            $fileTmp = $_FILES['image-upload']['tmp_name'];
            $fileTmp = file_get_contents($fileTmp);
            $fileTmp = base64_encode($fileTmp);
            if ($respons === "") {
                # Upload file
                $inputHeader = htmlentities(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
                $inputDescription = htmlentities(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));
        
                $this->stmtUploadImage->bindparam(':userID', $_SESSION['loggedInUser']);
                $this->stmtUploadImage->bindparam(':imageName', $fileTmp);
                $this->stmtUploadImage->bindparam(':title', $inputHeader);
                $this->stmtUploadImage->bindparam(':description', $inputDescription);
                $this->stmtUploadImage->execute();
        
                $respons =  "File uploaded!";
            }
            return $respons;
        }
    }
}