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
    
        
    foreach($users as $user){
            if($user->id == $value){
                $user_name = $user->user_name;  
            }
    }
        
    if($this->get()){    
    foreach($images as $image){
        
        if($image->$var == $value){
        $imageArr = array('id'=>$image->id, 'user_name'=>$image->user_name, 'image_name'=>$image->name, 'description'=>$image->description);
        
        $jason = json_encode($imageArr);
        
        echo $jason;
        echo "<br>";
        }
        }
        
    }  
        
        
    if($this->post()) {
        $image = json_decode(file_get_contents("php://input"));    
        
        //$image = json_decode($jason);
        
        /*$name = $_POST['name'];
        $description = $_POST['description'];
        
        echo "Here it comes;";
        echo "<br>";
        echo $name;
        echo $decription;
        */
      
        
        foreach($users as $user){
            if($user->id == $value){
            $newImage = new UploadImage($image->name, $user->user_name, $image->description);
            }
        }
        
        
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