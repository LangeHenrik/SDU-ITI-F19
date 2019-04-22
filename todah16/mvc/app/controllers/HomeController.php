<?php

        //require "../app/controllers/HeaderController.php";
        include_once "../app/core/Database.php";
        
?>

<!DOCTYPE html>
<html>
    
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file--->   
<link rel="stylesheet" type="text/css" href="\CSS\Dankify_FEED.css"/>
 
    
</head>     
    
<body>
    
<!--
Form that creates an upload button for the website along sending the form to the upload.inc.php file on a successful upload.
-->    

 <main>
     <section class = "section-default">     
    <?php
         
    class HomeController extends Controller {
    
      
        
    public function login(){
        $this->viewOnly('home/login');
    }    
         
    public function other () {
    $this->model('Image');  
    $this->model('Comment');    
    $db = new Database();    
    $images = $db->getImages();
    $comments = $db->getComments();
        
        
    $this->viewExtraViewbag('home/loggedIn', $images, $comments); 
        
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
        
    public function my_Images(){
        
    }    
        
    }
    ?>
    
         
         
  
     
     </section>
     
</main>
</body>
    
    
</html>