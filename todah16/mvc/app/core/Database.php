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
    
    public function getComments(){
        $sql = "SELECT * FROM comments;";
        $results = $this->queryToModelObject($sql);
        
        foreach($results as $result){
            $object_results[] = new Comment($result);
        }
        
        return $object_results;
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