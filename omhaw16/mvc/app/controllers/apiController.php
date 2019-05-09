<?php 

class APIController extends Controller {

public function __construct() { 

// echo "I am the API Controller!";

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

		header("Content-Type:application/json");
		if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {

			$strJsonFileContents = file_get_contents("php://input");
		//	echo json_decode($strJsonFileContents);

		//	print_r($strJsonFileContents);

			$decoder = json_decode($strJsonFileContents, true);

				$username = $decoder["username"];
				$password = $decoder["password"];
				$postedby = $userID;
				$imgname = $decoder["imgurl"];
				$imgtitle = $decoder["title"];
				$imgdesc = $decoder["desc"];

				echo $imgname . " - ";

			$objectOfUser = $this->model('User');
			$objectOfPics = $this->model('Pictures');

				echo "- test - ";

			    if($objectOfUser->login($username,$password)) {
			    	echo "Logged in!";

			    	$objectOfPics->uploadThruAPI($postedby,$imgname,$imgtitle,$imgdesc);

			    }
			    else { 
			    	echo "Not logged in. :(";
			    }

/*			$imageUrl = $strJsonFileContents['imgurl'];
			$title = $strJsonFileContents['title'];
			$description = $strJsonFileContents['desc'];
			$username = $strJsonFileContents['username'];
			$password = $strJsonFileContents['password']; */


//			$strJsonFileContents = file_get_contents(dirname(__FILE__) . "/JSON.json");
			
//			echo dirname(__FILE__);

// JJJ			echo json_encode($strJsonFileContents, JSON_PRETTY_PRINT);

			// print_r($strJsonFileContents);

//			$json = $_POST['json'];

//			$array = json_decode($json, true);

		//	print $array;

/*			$input = json_decode($_POST['json'], true);
			$imageUrl = $input['imgurl'];
			$title = $input['title'];
			$description = $input['desc'];
			$username = $input['username'];
			$password = $input['password'];*/

				}
			}
		}
	} 

	//		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			// 

		/*	$objectOfPics = $this->model('Pictures');
			$objectOfUser = $this->model('User');


//			$post = (array)json_decode(file_get_contents("php://input"));


//                    if(isset($post['userID'])) {

			$data = array(
			  'userID'      => $userID,
			  'image'    => 'logo.jpg',
			  'imgtitle' => 'Test',
			  'imgdesc' => 'test test'
				);	
			}

                    	echo "JSON YES.";
                        
 					$options = array(
					  'http' => array(
					    'method'  => 'POST',
					    'content' => json_encode( $data ),
					    'header'=>  "Content-Type: application/json\r\n" .
					                "Accept: application/json\r\n"
					    )
					);

					$context  = stream_context_create( $options );
					$result = file_get_contents( $url, false, $context );
					$response = json_decode( $result );

 //                       $jsonReceived = json_decode($_POST['json'], true); //get object from json

                    //    print_r($jsonReceived);
                        
                        $username = $jsonReceived["username"];
                        $password = $jsonReceived["password"];
        				$postedby = $userID;
                        $image = $jsonReceived["image"];
                        $imgtitle = $jsonReceived["imgtitle"];
                        $imgdesc = $jsonReceived["imgdesc"];
                        

                        $onePost = array();
                       
						$objectOfUser = $this->model('User');
                        if($objectOfUser->login($username,$password)) {
                          //  $check = 'data:image/jpeg;base64,'
   
                      //      if (substr($tmpImg, 0, strlen($check)) == $check)//if contains check string
//                            {
  //                              $tmpImg = substr($tmpImg, strlen($check));
    //                        }
        				
                            $send = $objectOfPics->uploadPic($userID, $image, $imgtitle, $imgdesc);	

                            $onePost['ID'] = $postID;
        
                            echo json_encode($onePost);

                        } else { 
                        	echo "Not logged in.";
                        	echo "Username: " . $username . " and password: " . $password;
                        }
          //          } else { 
          //          	echo "JSON not set.";
          //          	debug_print_backtrace();
          //          } 

                   

                }
     }

		/*		$objectOfPics = $this->model('Pictures');
				$objectOfUser = $this->model('User');

				header('Content-Type: application/json');
				$jsonFile = $_POST['json'];

			 if(isset($_POST['json'])) {

				$decoder = json_decode($jsonFile, true);

				$username = $decoder["username"];
				$password = $decoder["password"];
				$postedby = $decoder["postedby"];
				$imgname = $decoder["image"];
				$imgtitle = $decoder["title"];
				$imgdesc = $decoder["desc"];

				header('Content-type: application/json');
				echo json_encode($decoder);

//				echo "USERNAME: " . $username;

				if ($objectOfUser->login($username,$password)) { 
				$posted = $objectOfPics->uploadPic($userID,$imgname,$imgtitle,$imgdesc);
				
				echo json_encode($posted);

				echo "Upload done.";


			} else {
				echo "Couldn't log in with " . $username . "and " . $password;
			} 

		} else { 
	echo "JSON not set."; */