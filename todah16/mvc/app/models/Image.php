<?php
class Image extends Database {
	
	private $_id;
    private $_name;
    private $_user_name;
    private $_description;
    private $object_results = array();

    
    
    public function __construct (DatabaseQueryResult $result){
         $this->_id = $result->img_id;
        $this->_name = $result->name;
        $this->_user_name = $result->user_name;
        $this->_description = $result->description;
    }
  
    public function __get($var){
    switch ($var){
      case 'id':
        return $this->_id;
        break;
      case 'name':
        return $this->_name;
        break;
      case 'user_name':
        return $this->_user_name;
        break;
      case 'description':
        return $this->_description;
        break;
      default:
        return null;
        break;
    }
  }
  public function __toString(){
    return $this->_name;
  }
    
      
    
}