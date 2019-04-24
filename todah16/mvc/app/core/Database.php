<?php

require_once 'db_config.php';

class DatabaseQueryResult {
     
  private $_results = array();
 
  public function __construct(){}
 
  public function __set($var,$val){
    $this->_results[$var] = $val;
  }
 
  public function __get($var){  
    if (isset($this->_results[$var])){
      return $this->_results[$var];
    }
    else{
      return null;
    }
  }
}

	
class Database extends DB_Config {

	public $conn;
    
	public function __construct() {
		try {
			
			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
			$this->username,
			$this->password,
			
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	public function __destruct() {
		$this->conn = null;
	}
	
    public function getImages(){
        $sql = "SELECT * FROM images;";
        $results = $this->queryToModelObject($sql);
        
        foreach($results as $result){
            $object_results[] = new Image($result);
        }
        
        return $object_results;
    }
    
    public function getImagesByUser($user_name){
        $sql = "SELECT * FROM images WHERE user_name='".$user_name."';";
        $results = $this->queryToModelObject($sql);
        
        foreach($results as $result){
            $object_results[] = new Image($result);
        }
        
        return $object_results;
    }
    
    public function getComments(){
        $sql = "SELECT * FROM comments;";
        $results = $this->queryToModelObject($sql);
        
        foreach($results as $result){
            $object_results[] = new Comment($result);
        }
        
        return $object_results;
    }
    
    public function getUsers(){
        $sql = "SELECT * FROM users;";
        $results = $this->queryToModelObject($sql);
        
        foreach($results as $result){
            $object_results[] = new User($result);
        }
        
        return $object_results;
    }
    
    public function addNewUser($NewUser){
        $sql = "INSERT INTO `users`(`user_name`, `passw`, `first_name`, `last_name`, `zip`, `city`, `email`, `phone_number`) VALUES ('".$NewUser->user_name."','".$NewUser->passw."','".$NewUser->first_name."','".$NewUser->last_name."','".$NewUser->zip."','".$NewUser->city."','".$NewUser->email."','".$NewUser->phone_number."')";
        $this->conn->query($sql);
     
    }
    
    public function addNewComment($NewComment){
         $sql = "INSERT INTO `comments`(`user_name`, `img_id`, `text`) VALUES ('".$NewComment->user_name."','".$NewComment->id."','".$NewComment->text."')";
        $this->conn->query($sql);
    }  
    
    public function addNewImage($NewImage){
        $sql = "INSERT INTO `images` (`name`, `description`, `user_name`) VALUES ('".$NewImage->name."','".$NewImage->description."','".$NewImage->user_name."')";
        $this->conn->query($sql);
    }
    
    
    private function queryToModelObject($sql){
 
    //$connection = $this->conn;   
    $res = $this->conn->query($sql);
 
    if ($res){
      if (strpos($sql,'SELECT') === false){
        return true;
      }
    }
    else{
      if (strpos($sql,'SELECT') === false){
        return false;
      }
      else{
        return null;
      }
    }
 
    $results = array();
 
    while ($row = $res->fetch()){
 
      $result = new DatabaseQueryResult();
 
      foreach ($row as $k=>$v){
        $result->$k = $v;
      }
 
      $results[] = $result;
    }
    return $results;        
  }     
}