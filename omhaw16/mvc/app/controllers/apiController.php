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

public function pictures($param,$userID) {

	if ($param == "user") { 
			if ($this->get()) {
				$objectOfPics = $this->model('Pictures');
				$picJSON = $objectOfPics->getMyPosts($userID);

				echo json_encode($picJSON);
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

	if ($objectOfUser->checkUserByID($userID,$username)) {

	        if($objectOfUser->loginAPI($username,$password)) {

	              	$ext = 'png';
	                $filename = uniqid();
	                $fullfilename = $filename.'.'.$ext;

	                $path = '../app/models/uploads/'.$fullfilename;

	             //   $insertionURL = 'uploads/'.$fullfilename;

	                preg_match("/\b(jpg|JPG|png|PNG|gif|GIF|bmp|BMP)\b/", $img_base64, $output);

	                $fullfilename = $filename .'.'. $output[0];

	                echo " File name: " . 	$fullfilename;

	                $tryToUpload = $objectOfPics->uploadDBThruAPI($postedby,$fullfilename,$imgtitle,$imgdesc);
  
	                        $imgstring = $img_base64;
	                        $imgstring = trim( str_replace('data:image/'.$ext.';base64,', "", $imgstring ) );
	                        $imgstring = str_replace( ' ', '+', $imgstring );
	                        $data = base64_decode( $imgstring );
                      
	                        $didItUpload = file_put_contents($path, $data );


	                        if($didItUpload){
	                         echo " Picture uploaded to folder! ";
	                         echo "Thank you for using PhotoPost! :) ";
	                        }else{
	                         echo "Upload failed";
	                        }
	                    	        
	        } else { 
	            echo "Not logged in. :(";
	        }
	    } else { 
	    	echo "User ID does not match username in JSON input. Please try again.";
	    }
	    }
	}
	} else {
		echo "Please provide parameter (e.g pictures/user) :)";
	}
}
}