<?php
class NewComment extends Database {
	
    private $_user_name;
    private $_text;
    private $_id;
    private $object_results = array();

    
    
    public function __construct ($user_name, $text, $img_id){
        $this->_user_name = $user_name;
        $this->_text = $text;
        $this->_id = $img_id;
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