<?php


class ApiController extends Controller {
    
    
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
                $user_name = $user->user_name;  
            }
    }
        
    if($this->get()){     
    
    $userImages = $db->getImagesByUser($user_name);
        
    foreach($userImages as $image){
        $imageArr = array('id'=>$image->id, 'user_name'=>$image->user_name, 'image_name'=>$image->name, 'description'=>$image->description);
        
        $jason = json_encode($imageArr);
        
        echo $jason;
        echo "\n";
        }
        
    }  
        
        
    if($this->post()) {
        echo "I work too";
        $image = json_decode(file_get_contents("php://input"));    
        
        
        $newImage = new UploadImage(basename($image->image_name), $user_name, $image->description);
        
        echo $newImage->user_name;
        echo $newImage->name;
        echo $newImage->description;
        
        $db->addNewImage($newImage);
        
        echo "I work too";
        
        $this->service('uploadService');
        
        $uploadService = new UploadService();
        
        $uploadService->uploadFromPOST($newImage);
        
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
        
        foreach($users as $user){
            $usersArr = array('id'=>$user->id, 'user_name'=>$user->user_name);
        
            $jason = json_encode($usersArr);
            
            
            
        echo $jason;
        echo "<br>";    
        }
        
    }
        
    
    
    
    
    
}