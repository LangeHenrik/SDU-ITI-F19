<?php
class NewUser extends Database {
    private $_user_name;
    private $_passw;
    private $_first_name;
    private $_last_name;
    private $_zip;
    private $_city;
    private $_email;
    private $_phone_number;
    private $object_results = array();

    
    
    public function __construct ($user_name, $passw, $first_name, $last_name, $zip, $city, $email, $phone_number){
        $this->_user_name = $user_name;
        $this->_passw = $passw;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_zip = $zip;
        $this->_city = $city;
        $this->_email = $email;
        $this->_phone_number = $phone_number;
    }
  
    public function __get($var){
    switch ($var){
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
      default:
        return null;
        break;
    }
  }
  public function __toString(){
    return $this->_user_name;
  }
    

    
    
}