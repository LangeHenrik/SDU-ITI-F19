<?php
class ServiceController extends Controller {
    private $userModel;
    private $db;     
    private $users;
    private $newUserModel;
    private $uploadImageModel;
    private $newCommentModel;
    
    function __construct () {
        $this->userModel = $this->model('User');
        $this->newUserModel = $this->model('NewUser');
        $this->uploadImageModel = $this->model('uploadImage');
        $this->newCommentModel= $this->model('NewComment');
        $db = new Database();     
    
        $this->users = $db->getUsers();
    }
    
    public function login(){
        $this->service('loginService');
        $loginService = new LoginService();
        
        
        //$users = this->$users
        
        $loginService->login($this->users);
    }
    
    public function logout(){
        
        $this->service('logoutService');
        $logoutService = new LogoutService();
        
        $logoutService->logout();
    }
    
    public function register(){
        $this->service('registerService');
        
        $registerService = new RegisterService();
        
        $newUser = $registerService->register($this->users, $this->newUserModel);
        
        if($newUser == null){
             header("Location: /todah16/mvc/public/home/register");
        } 
        
        $db = new Database();
        
        
        $db->addNewUser($newUser);
        
        header("Location: /todah16/mvc/public/home/login");
    }
    
    public function upload(){
        $this->service('uploadService');
        
        $uploadService = new UploadService();
        
        $uploadImage = $uploadService->upload($this->uploadImageModel);
        echo $uploadImage->name;
        $db = new Database();
        $db->addNewImage($uploadImage);
        
        header("Location: /todah16/mvc/public/home/other");
        
        
    }
    
    public function comment($id){
        
        $db = new Database();
        $user_name =$_SESSION['user_name'];
        $comment = $_POST['comment'];
        
        $this->model('NewComment');
        
        $newComment = new NewComment($user_name, $comment, $id);
        
        
        
        $db->addNewComment($newComment);
        
        header("Location: /todah16/mvc/public/home/other");
    }
    
    public function delete(){
        if($this->post()){
        //$id = $_POST['id']   
        
        //echo $_POST['id'];    
            
        $db = new Database();
        if($db->deleteImageOnID($_POST['id'])){
            echo 1;
        } else {
            echo 0;
        }    
            
        }
        
    }
    

}