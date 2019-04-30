<?php

class UserImages extends Database {
    
    private $preparedGetImages;
    private $preparedGetInitialImages;
    private $preparedGetFileName;
    private $preparedRemoveImage;

	public function __construct() {
        parent::__construct();
        
		$this->preparedGetImages=$this->conn->prepare('SELECT * FROM media where uploaded_by=:userid order by id desc LIMIT :offset,4');
		$this->preparedGetInitialImages=$this->conn->prepare("SELECT * FROM media where uploaded_by=:userid order by id desc limit 20");
		$this->preparedRemoveImage=$this->conn->prepare("DELETE FROM media where id=:id");
    }
    
    public function loadInitialImages(){
        $this->preparedGetInitialImages->bindParam(':userid',$_SESSION["loggedInUser"],PDO::PARAM_INT);
        $this->preparedGetInitialImages->execute();
        $this->preparedGetInitialImages->setFetchMode(PDO::FETCH_ASSOC);
        $payload = $this->preparedGetInitialImages->fetchAll();
        return $payload;
    }

    public function getimages(){
        if(isset($_GET["offset"])){
            $this->preparedGetImages->bindParam(':offset',$_GET["offset"],PDO::PARAM_INT);
            $this->preparedGetImages->bindParam(':userid',$_SESSION["loggedInUser"],PDO::PARAM_INT);
            $this->preparedGetImages->execute();
            $this->preparedGetImages->setFetchMode(PDO::FETCH_ASSOC);
            $result=$this->preparedGetImages->fetchAll();
            $this->preparedGetImages=null;
            
            $columns=array();
            
            if(sizeof($result)==0){
                echo '0';
            }else{
                foreach($result as $row){
                    $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="data:image/;base64,'.$row['media_name'].'"><p>'.$row['description'].'</p><form action="/magle17/mvc/public/UserImages/removeImage/" method="post"><input type="hidden" name="image-id" value="'.$row['id'].'"><input type="submit" name="remove-image" value="Slet"></form></div>';
                    array_push($columns,$tmp);
                }
                echo json_encode($columns);
            }  
        }
    }

    public function removeImage(){
        $imageid=$_POST["image-id"];

        $this->preparedRemoveImage->bindParam(':id',$imageid,PDO::PARAM_INT);
        
        if($this->preparedRemoveImage->execute()){
            return 'Det blærede billede, med id '.$imageid.', er blevet slettet......';
        }else{
            return 'Det blærede billede blev ikke slettet!';
        }
    }
}
