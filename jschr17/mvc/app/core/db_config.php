<?php
class DB_Config {
	protected $servername = 'localhost';
	protected $username = 'root';
	protected $password = 'master070';
	protected $dbname = 'MVC_Data';

    public function getDBName(){
        return $this->dbname;
    }

    /**
     * @return string
     */
    public function getServername()
    {
        return $this->servername;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


}

	
	