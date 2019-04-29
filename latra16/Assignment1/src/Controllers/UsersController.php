<?php

namespace Controllers;

use Router\IRequest;
use Models\User;
use Services\DBService;
use config\Database;

class UsersController extends Controller{

    private $db;

    public function __construct(){
       parent::__construct();
       $this->db = new DBService(new Database());
    }

    /**
     * 
     */
    public function render(IRequest $request) : string {
        return $this->html("Users", ["users" => $this->db->getUsers(10)]);
    }
    
}

?>