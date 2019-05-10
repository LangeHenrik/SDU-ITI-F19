<?php

require_once ("C:\Users\malte\Documents\GitHub\SDU-ITI-F19\mahes17\Assignment2\mvc\app\core\database.php");

require_once 'User.php';
require_once 'Picture.php';


class ApiModel extends Controller {

     public function getPicture ($user, $image){
       echo $user . $image;
     }


}
