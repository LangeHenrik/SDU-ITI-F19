<?php

class ApiController extends Controller {
	private $viewbag=[];
	public function index () {
        echo "This is a public API!";
        $someArray = [
            [
              "name"   => "Jonathan Suh",
              "gender" => "male"
            ],
            [
              "name"   => "William Philbin",
              "gender" => "male"
            ],
            [
              "name"   => "Allison McKinnery",
              "gender" => "female"
            ]
          ];
        
          // Convert Array to JSON String
          $someJSON = json_encode($someArray);
          echo $someJSON;
    }

    public function users(){
        $model =$this->model("Api");
        $users=$model->getUsers();

        echo json_encode($users);
    }

    public function pictures($param1,$param2){
        if($this->post()){
            echo $_POST['json'];
        }else if($this->get()){
            $model=$this->model("Api");
            $images=$model->getUserImages($param2);
            echo json_encode($images);
        }
    }
}