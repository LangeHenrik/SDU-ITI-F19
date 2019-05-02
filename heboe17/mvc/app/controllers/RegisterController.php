<?php
class RegisterController extends Controller {
	
	public function index () {
		
		$viewbag = $this->initialiseViewbag();
		
		$this->view('home/Register', $viewbag);
	}
	
	public function register () {
		$viewbag = $this->initialiseViewbag();
		
		if($this->post()) {
			$post_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$post_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
			$repeat_password = filter_input(INPUT_POST, "password_repeat", FILTER_SANITIZE_STRING);
			$email =  filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
			$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
			$zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT);
			$first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
			$last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
			$city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
			
			$regex_Username = "/^([A-Za-z0-9]){1}([A-z0-9]|[-_]){0,19}$/";
			$regex_Password = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\S{8,})/";
			$regex_Name = "/^[A-Z]([a-z]{0,99})$/";
			$regex_Name_last = "/^[A-Z]([a-z]{0,99})$/";
			$regex_Email = "/(^([A-z]+[.]?[A-z]+)+@([A-z]+[.]?[A-z]+)+[.][a-z]{2,5}$)/";
			$regex_Phone = "/^[+][0-9]{8,30}$/";
			$regex_Zip = "/^[0-9]{4}$/";
			$regex_City = "/^(?=.[a-zA-Z ]{1,99}$)(^([A-Z]([a-z]*)+\s?)+$)/";
			
			$username_match = preg_match($regex_Username, $post_username);
			$password_match = preg_match($regex_Password, $post_password);
			$first_name_match = preg_match($regex_Name, $first_name);
			$last_name_match = preg_match($regex_Name_last, $last_name);
			$email_match = preg_match($regex_Email, $email);
			$phone_match = preg_match($regex_Phone, $phone);
			$zip_match = preg_match($regex_Zip, $zip);
			$city_match = preg_match($regex_City, $city);
			
			if ($post_password === $repeat_password){
				$repeat_password_match = 1;
				$passwordHash = password_Hash($post_password, PASSWORD_DEFAULT);
			} else {
				$repeat_password_match = 0;
			}

			$viewbag['username']=$post_username;
			$viewbag['email']=$email;
			$viewbag['phone']=$phone;
			$viewbag['zip']=$zip;
			$viewbag['first name']=$first_name;
			$viewbag['last name']=$last_name;
			$viewbag['city']=$city;
			
			$name = $_FILES['image']['name'];
			$target_dir = "upload/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$extensions_arr = array("jpg","jpeg","png","gif");
			
			if( in_array($imageFileType,$extensions_arr) ){
				$image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

				$user = $this->model('User');
				
				if ($username_match && $password_match && $repeat_password_match && $first_name_match && $last_name_match && $email_match && $phone_match && $zip_match && $city_match){
					
					$user_exists = $user->userExists($post_username);
					$email_exists = $user->emailExists($email);
					
					if (!$user_exists && !$email_exists){
						$user->addUser($post_username, $passwordHash, $email, $phone, $zip, $first_name, $last_name, $city, $image);
						header("Location: /heboe17/mvc/public/Login");
					}
					
					if ($user_exists){
						$viewbag['username']="That username was already taken";
					}
					
					if ($email_exists){
						$viewbag['email']="That email is in use";
					}
								
					$viewbag['user_exists']=$user_exists;
					$viewbag['email_exists']=$email_exists;
				}
			}
		}
		$this->view('home/Register', $viewbag);	
	}
	
	private function initialiseViewbag(){
		$viewbag['user_exists'] = false;
		$viewbag['email_exists'] = false;
		 
		$viewbag['username'] = "";
		$viewbag['email'] = "";
		$viewbag['phone'] = "";
		$viewbag['zip'] = "";
		$viewbag['first name'] = "";
		$viewbag['last name'] = "";
		$viewbag['city'] = "";
		
		return $viewbag;
	}
	
	

}
