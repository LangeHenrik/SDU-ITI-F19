<?php

  class ApiController extends Controller {


    public function Pictures($user, $image){
      include_once("C:\Users\malte\Documents\GitHub\SDU-ITI-F19\mahes17\Assignment2\mvc\app\models\API.php");

      $model = new API();

      if(isset($_SESSION['user_id'])){
          $model->getApi();
      }
    }


  }
