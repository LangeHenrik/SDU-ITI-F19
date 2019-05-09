<?php 

class APIController extends Controller {

public function __construct() { 

}

public function testMe() {

	echo " - Here I am!";
}

public function users() {
            if ($this->get()) {
                $objectOfUser = $this->model('User');
                $userArray = $objectOfUser->getAllUsers();
                                
                echo json_encode($userArray);
                
            }
        }

public function pictures($userID) {

			if ($this->get()) {
				$objectOfPics = $this->model('Pictures');
				$picJSON = $objectOfPics->getMyPosts($userID);

//				echo json_encode($picJSON);	

				echo json_encode($picJSON);
//				echo json_encode($objectOfPics);

			}

			if ($this->post()) {

		$objectOfPics = $this->model('Pictures');
		$objectOfUser = $this->model('User');

		header("Content-Type:application/json");

	    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
	        $strJsonFileContents = file_get_contents("php://input");
	  
	        $decoder = json_decode($strJsonFileContents, true);
	        
	        $postedby = $userID;
	        $username = $decoder["username"];
	        $password = $decoder["password"];
	        $img_base64 = $decoder["image"];
	        $imgtitle = $decoder["title"];
	        $imgdesc = $decoder["description"];

	        if($objectOfUser->loginAPI($username,$password)) {
	                
	              	$ext = 'png';
	                $image_name = "Lmaobruh";
	                $image_name_with_ext = $image_name.'.'.$ext;

	                $path = '../app/models/uploads/'.$image_name_with_ext;

	                $insertion_url = 'uploads/'.$image_name_with_ext;

	                $decoded_img = base64_decode($img_base64);
	                $insertCheck = $objectOfPics->uploadB64ThruAPI($postedby,$image_name_with_ext,$imgtitle,$imgdesc);

	                        $imgstring = $img_base64;
	                        $imgstring = trim( str_replace('data:image/'.$ext.';base64,', "", $imgstring ) );
	                        $imgstring = str_replace( ' ', '+', $imgstring );
	                        $data = base64_decode( $imgstring );
                      
	                        $status = file_put_contents($path, $data );


	                        if($status){
	                         echo "Successfully Uploaded";
	                        }else{
	                         echo "Upload failed";
	                        }
	                    

	                    echo "Picture uploaded successfully!";
	        
	        } else { 
	            echo "Not logged in. 😞";
	        }
	    }
	}
	}
}