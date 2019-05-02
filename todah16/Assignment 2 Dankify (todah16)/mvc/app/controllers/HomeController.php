<?php
         
    class HomeController extends Controller {
    
    private $comments;
        
    
      
        
    public function login(){
        $this->viewOnly('home/login');
    }    
         
    public function other () {
    $this->model('Image');  
    $this->model('Comment');
    $this->model('NewComment');
    $this->model('User');  
    $db = new Database();    
    $images = $db->getImages();
    $comments = $db->getComments();
    $users = $db->getUsers();
    
        
        
    
        $this->view('partials/users', $users);
    $this->viewExtraViewbag('home/loggedIn', $images, $comments);
        
    
    /*    
    $this->view('partials/users', $users);
    */    
    
    }
    public function logout(){
        if(isset($_POST['logout'])){    
            session_start();
            session_unset();
            session_destroy();
            $this->viewOnly('home/loggedIn');
        }else {
            $this->viewOnly('home/login');
            exit();    
        }
    }
        
    public function register(){
        $this->viewOnly('home/register');
    }
        
    public function myImages($user_name){
       $this->model('Image');  
        $this->model('Comment');    
            
        $db = new Database();
        
        $userImages = $db->getImagesByUser($user_name);
        $comments = $db->getComments();
        
        $this->viewExtraViewbag('home/myImages', $userImages, $comments);
        
        
    }
        
        
    public function index(){
        $this->other();
    }
        
        
        
    }
