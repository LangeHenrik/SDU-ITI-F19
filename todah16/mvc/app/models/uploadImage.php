<?php

class UploadImage extends Database {
	
    private $_name;
    private $_user_name;
    private $_description;
    private $object_results = array();

    
    
    public function __construct ($name, $user_name, $description){
        $this->_name = $name;
        $this->_user_name = $user_name;
        $this->_description = $description;
    }
  
    public function __get($var){
    switch ($var){
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