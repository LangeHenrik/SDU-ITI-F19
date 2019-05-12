<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/models/Post.php';
    class apiController extends Controller {
        
        //GET all users
        public function users() {
            if ($this->get()) {
                $userObject = $this->model('User');
                $userArray = $userObject->getUsers();
                
                foreach($userArray as $user){

                    $singleUserArray['user_id'] = $user[0];
                    $singleUserArray['username'] = $user[1];
                    $usersObject[] = $singleUserArray;
                }
                
                echo json_encode($usersObject);
                
            }
        } 

        public function pictures($param,$userid) {
            $userObject = $this->model('User');
            
            //GET user pictures
            if ($this->get()) {
                
                if ($param == "user") {
                    $userArray = $userObject->getUsers();
                    
                    foreach($userArray as $user) {
                        if ($userid == $user[0]) {
                            $userPosts = $userObject->fetchUserPosts($userid);
                            if ($userPosts != null) {
                                foreach ($userPosts as $userPost) {
                                    
                                    $base64decodedimg = base64_encode(file_get_contents('../app/'.$userPost[4]));
                                    
                                    $postArray['image'] = $base64decodedimg;
                                    $postArray['title'] = $userPost[2];
                                    $postArray['description'] = $userPost[3];

                                    $usersObject[] = $postArray;
                                }
                                
                            }
                            
                        }
                    }
                    
                    echo json_encode($usersObject);
                    
                }
            }

            //POST user pictures
            if ($this->post()) {
                if ($param == "user") {
                    
                    
                    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
                        $strJsonFileContents = file_get_contents("php://input");
                        $decoder = json_decode($strJsonFileContents, true);
                        
                        $img_base64 = $decoder["image"];
                        $imgheader = $decoder["title"];
                        $imgdesc = $decoder["description"];
                        $username = $decoder["username"];
                        $password = $decoder["password"];
                        
                        $postedby = $userObject->getUserIdByUsername($username);

                        if($userid != null) {
                            if ($postedby == $userid) {
                                $hashed_password = $userObject->getHashedPasswordById($userid);
                                if (password_verify($password, $hashed_password)) {
                                    
                                    $imgstring = $img_base64;
                                    $ext = '';
                                    $image_name = uniqid();
                                    
                                    //checking whether the base64 code contains any of the given cases for picture extension.
                                    preg_match("/\b(webp|jpeg|JPEG|jpg|JPG|png|PNG|gif|GIF)\b/", $imgstring, $output_array);

                                    $image_name_with_ext = $image_name.'.'.$output_array[0];
    
                                    $path = '../app/uploads/'.$image_name_with_ext;
    
                                    $insertion_url = 'uploads/'.$image_name_with_ext;
                                    
                                    $returnedId = $userObject->insertPost($imgheader,$imgdesc,$insertion_url,$userid);
                                    
                                    if ($returnedId != null) {

                                            $imgstring = trim( str_replace('data:image/'.$output_array[0].';base64,', "", $imgstring ) );
                                            
                                            
                                            $imgstring = str_replace( ' ', '+', $imgstring );
                                            $data = base64_decode( $imgstring );

                                            $status = file_put_contents($path, $data );
    
    
                                            if($status){
                                                $val = json_encode(array(
                                                    "image_id"=>$returnedId,
                                                ));
                                                
                                                $data = json_decode($val);
                                                echo json_encode($data);
                                                
                                            } else{
                                                echo "Upload failed... ";
                                            }
                                        
                                    } else {
                                        echo "Cannot upload... ";
                                    }
                                }
                            } else {
                                echo "Userid doesn't match with the given username... ";
                            }
                            
                        } else { 
                            echo "Not logged in. 😞 ";
                        }
                    }
                }
            }
        }
    }
    
?>
