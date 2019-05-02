<?php

namespace Controllers;

use Router\IRequest;
use Models\DTO\PhotoDTO;
use Models\User;
use Services\DBService;
use config\Database;

class PhotosController extends Controller{

    private $db;

    public function __construct(){
       parent::__construct();
       $this->db = new DBService(new Database());
    }

    /**
     * 
     */
    public function render(IRequest $request) : string {
        return $this->html("Photos", ["photos" => $this->db->getPhotos(20)]);
    }

    public function getUpload(IRequest $request){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['username'])){
            header('Location: /', true, 303);
            die();   
        }
        return $this->html("UploadPhoto");
    }

    public function getDetails(IRequest $request){
        $photoId = $request->getBody()["photo_id"];
        $photo = $this->db->getPhotoById($photoId);
        return json_encode($photo);
    }

    public function uploadPhoto(IRequest $request){
        session_start();
        $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/assets/img/";
        $body = $request->getBody();
        $ext = pathinfo($body["_FILES"]["file"]["name"], PATHINFO_EXTENSION);
        $photoName = hash("ripemd160", $body["_FILES"]["file"]["name"].time()) . "." . $ext;
        $user = $this->db->getUserByUsername($_SESSION["username"]); 
        $photo = new PhotoDTO($photoName, $body['title'], $body['caption'], $user->id);
        $this->db->uploadPhoto($photo);
        $target_file = $target_dir . $photoName;
        move_uploaded_file($body["_FILES"]["file"]["tmp_name"], $target_file);     
        
        header('Location: /photos', true, 303);
        die();
    }
    
}

?>