<?php


class ApiController extends Controller {
    
    private $username;
    private $password;
    
    public function pictures($var, $value){
    $this->model('Image');
    $this->model('uploadImage'); 
    $this->model('User');      
    $db = new Database();    
    $images = $db->getImages();
    $users = $db->getUsers();
    
        
        
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods');
    $user_name = "";
    foreach($users as $user){
            if($user->$var == $value){
                $this->username = $user->user_name;
                $this->password = $user->passw;
            }
    }
        
    if($this->get()){     
    
    $userImages = $db->getImagesByUser($this->username);
    $entries = array();
        
    foreach($userImages as $image){
             
         $obj = new StdClass();
         $obj->image_id = $image->id;
         $obj->title = $image->description;
         $obj->description = $image->description;
         $obj->image = "/todah16/mvc/public/Uploads/".$image->name;
         array_push($entries, $obj);
        
        }
        echo json_encode($entries);
        
        
    }  
        
        
    if($this->post()) {
        $jason = json_decode($_POST["json"]);
        
        $db = new Database();
        $randomNumberLength = 8;
        if($this->checkUser($jason->username, $jason->password)){
            $randomNumber = rand(0, $randomNumberLength);
            $pos  = strpos($jason->image, ';');
            $type = explode('/', explode(':', substr($jason->image, 0, $pos))[1])[1];
					
            $newPath = "Uploads\\TestFile".$randomNumber . "." . $type;
					
            $data = explode(',', $jason->image);
            $content = base64_decode($data[1]);
            $_SESSION["user_name"] = $jason->username;
            
            $this->service('uploadService');
        
            $uploadService = new UploadService();
        
            $uploadService->uploadFromPOST($newPath, $content);
            
            $newImage = new UploadImage(basename($newPath), $jason->username, $jason->description);
            $imageID = $db->addNewImage($newImage);
            
            unset($_SESSION["user_name"]);
            
            $obj = new StdClass();
            $obj->image_id = (int) $imageID;
            
            echo json_encode($obj);
            
            
        }
        
    }
        
    }
    
    
    
    
    private function checkUser($username, $password){
        
        if($username == $this->username && $password = $this->password){
            return true;
        } else{
            return false;
        }
    }
    
    
    public function images(){
         $this->model('Image');  
    $db = new Database();    
    $images = $db->getImages();
    
        
    foreach($images as $image){
        $imageArr = array('id'=>$image->id, 'user_name'=>$image->user_name, 'image_name'=>$image->name, 'description'=>$image->description);
        $jason = json_encode($imageArr);
            echo $jason;
            echo "<br>";
        
        }
    }
    
    
    public function comments(){
       $this->model('Comment');
        $db= new Database();
        $comments = $db->getComments();
        
        
        foreach ($comments as $comment){        
        $commentArr = array('id'=>$comment->id, 'user_name'=>$comment->user_name, 'text'=>$comment->text);
        
        $jason = json_encode($commentArr);
        
        echo $jason;
        echo "<br>";
        
        }
        
    }
    
        
    public function users(){
        $this->model('User');  
        $db = new Database();    
        $users = $db->getUsers();
        $entries = array();
    
        
        foreach($users as $user){
            $obj = new StdClass();
            $obj->user_id = $user->id;
            $obj->username = $user->user_name;
            array_push($entries, $obj);
        
             
        }
        echo json_encode($entries);
        
    }
        
    
    
    
    
    
}