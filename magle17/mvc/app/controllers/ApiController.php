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
        header("Content-Type:application/json");
        echo json_encode($users);
    }

    public function pictures($param1,$param2){
      header("Content-Type:application/json");
      $model=$this->model("Api");
        if($this->post()){
            $body=json_decode($_POST['json'],true);
            $image=$body["image"];
            $title=$body["title"];
            $description=$body["description"];
            $username=$body["username"];
            $password=$body["password"];

            $check=$model->checkLogin($username,$password);
            if($check==$param2){

              $imageid=$model->saveImage($check,$image,$title,$description);

              $arr=array('image_id'=>$imageid);
              echo json_encode($arr);
            }else{
              echo $check;
            }


        }else if($this->get()){
            $images=$model->getUserImages($param2);
            echo json_encode($images);
        }
    }
}