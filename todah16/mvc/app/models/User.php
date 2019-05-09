<?php
class User extends Database {
	

	
	private $_id;
    private $_user_name;
    private $_passw;
    private $_first_name;
    private $_last_name;
    private $_zip;
    private $_city;
    private $_email;
    private $_phone_number;
    private $object_results = array();

    
    
    public function __construct (DatabaseQueryResult $result){
         $this->_id = $result->user_id;
        $this->_user_name = $result->user_name;
        $this->_passw = $result->passw;
        $this->_first_name = $result->first_name;
        $this->_last_name = $result->last_name;
        $this->_zip = $result->zip;
        $this->_city = $result->city;
        $this->_email = $result->email;
        $this->_phone_number = $result->phone_number;
    }
  $user->user
    public function __get($var){
    switch ($var){
      case 'id':
        return $this->_id;
        break;
      case 'user_name':
        return $this->_user_name;
        break;
      case 'passw':
        return $this->_passw;
        break;
      case 'first_name':
        return $this->_first_name;
        break;
      case 'last_name':
        return $this->_last_name;
        break;
      case 'zip':
        return $this->_zip;
        break;
      case 'city':
        return $this->_city;
        break;
      case 'phone_number':
        return $this->_phone_number;
        break;
      case 'user':
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