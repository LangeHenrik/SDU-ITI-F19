<?php


class ApiController extends Controller {
    
    
    public function pictures($var, $value){
    $this->model('Image');
    $this->model('uploadImage'); 
    $this->model('User');      
    $db = new Database();    
    $images = $db->getImages();
    $users = $db->getUsers();
        
        
    
    if($this->get()){    
    foreach($images as $image){
        
        if($image->$var == $value){
        $imageArr = array('id'=>$image->id, 'user_name'=>$image->user_name, 'image_name'=>$image->name, 'description'=>$image->description);
        
        $jason = json_encode($imageArr);
        
        echo $jason;
        echo "<br>";
        }
        }
        
    } else if($this->post()) {
        $jason = file_get_contents('http://localhost:8080/todah16/mvc/public/api/pictures/"'.$var.'"/"'.$value.'"');    
        
        $image = json_decode($jason);
        
        
        foreach($users as $user){
            if($user->id == $value){
            $newImage = new UploadImage($image->name, $user->user_name, $image->description);
            }
        }
        
        echo $newImage;
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