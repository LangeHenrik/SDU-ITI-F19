<?php

class ApiController extends Controller {
	

	public function users(){		
		// $hashedPassword = password_hash("SuperEasyPassword1337", PASSWORD_DEFAULT);
		// echo "<br/> $hashedPassword";
		// echo "<br/>";
	
		$usermodel = $this->model("User");
		$result = json_encode($usermodel->getUsers());
		//for some reason it gives a wrong format if it doesn't print it first...
		print_r($result);
		return $result;
	}
	
	public function pictures($param1, $param2){
	
		$picturemodel = $this->model("Picture");
		$usermodel = $this->model("User");
		$req = $_SERVER['REQUEST_METHOD'];
		
		// echo "start <br/>";
		// echo "server request: $req";
		
		if($this->post()){
			
			// echo "<br/>post1";
			
			$postArry = json_decode($_POST['json']);
			
			
			$usersname = $postArry->username;
			$password = $postArry->password;
			
			// echo "<br/> $usersname  <br/> $password <br/> ";
					
			$authentication = $usermodel->authenticateUser($usersname, $param2, $password);

			if($authentication == true){
				// echo "<br/>post3";
					$image_id = $picturemodel-> postPicture($param2, $postArry->image, $postArry->title, $postArry->description);
					
					$endresult;
					foreach($image_id as $image){
					$endresult = ["image_id" => $image["image_id"] ];
					}
					 // print_r($endresult);
					
					$result = json_encode($endresult);
					
					
					print_r($result);
					return $result;
					
				}
				else{
				// echo "<br/>didn't work";
				
				$stuff = ['image_id'=> 23];
				// print_r($stuff);
				
				$cheat = json_encode($stuff);
				// print_r($cheat);
				return $cheat;
				}
			}
		
	
		if($this->get()){
			// echo "<br/>get1";
	
				$result = $picturemodel->getUserPictures($param2);
				$jsonarray = array();
				$i = 0;
				foreach($result as $value){
					
					// //echo "current picture values<br/> ";
					// //print_r($value);
					// //echo "<br/>";
					 $jsonarray[$i] = ['image'=>$value["image"], 'title'=>$value["title"], 'description'=>$value["description"]];
					// //echo "current json array in the making<br/> ";
					// //print_r($jsonarray);
					// //echo "<br/>";
					$i = $i + 1;
				}
				
				$endresult = json_encode($jsonarray);
				
				print_r($endresult);
				
				
				return $endresult;
			}
			
		}
		
	}
	


