<?php
class Comment extends Database {
	
    private $_user_name;
    private $_text;
    private $_id;
    private $object_results = array();

    
    
    public function __construct (DatabaseQueryResult $result){
        $this->_user_name = $result->user_name;
        $this->_text = $result->text;
        $this->_id = $result->img_id;
    }
  
    public function __get($var){
    switch ($var){
      case 'user_name':
        return $this->_user_name;
        break;
      case 'text':
        return $this->_text;
        break;
      case 'id':
        return $this->_id;
        break;
      default:
        return null;
        break;
    }
  }
  public function __toString(){
    return $this->_user_name;
  }
    
    
    
    
}