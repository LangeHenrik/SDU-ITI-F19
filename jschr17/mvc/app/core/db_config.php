<?php
class DB_Config {
	protected $servername = 'localhost';
	protected $username = 'root';
	protected $password = 'master070';
	protected $dbname = 'MVC_Data';

    public function getDBServername(){
        return this::$servername;
    }

    public function getDBUsername(){
        return this::$username;
    }

    public function getDBPassword(){
        return this::$password;
    }

    public function getDBName(){
        return this::$dbname;
    }
}

	
	