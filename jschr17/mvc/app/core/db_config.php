<?php
class DB_Config {
    //LOCAL DATABASE (HeidiSQL)
	protected $servername1 = 'localhost';
	protected $username1 = 'root';
	protected $password1 = 'master070';
	protected $dbname1 = 'MVC_Data';


	//ONLINE DATABSE (remotemysql)
    protected $servername2 = 'remotemysql.com';
    protected $username2 = 'DrDtoLDkRk';
    protected $password2 = '7ZPwZjfx9K';
    protected $dbname2 = 'DrDtoLDkRk';

    public function getDBName(){
        return $this->dbname2;
    }

    /**
     * @return string
     */
    public function getServername()
    {
        return $this->servername2;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username2;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password2;
    }


}

	
	