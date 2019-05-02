<?php
session_start();    
/* header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');    */     
//header('Acces-Control-Allow-Origin: *');
//ini_set('display_errors', 1);

Class User extends Database {
    // Set user properties
    private $UserID;
    private $Username;
    private $First_Name;
    private $Last_Name;
    private $Zip;
    private $City;
    private $Email;
    private $Phone_Number;
    private $Profile_Image;

    // Db properties
    private $conn;
    private $table = 'users';

    public function __construct()
    {
        $this->conn = parent::connect();
    }


    public function login($username, $password) {
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE username = '$username';");
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    
        } catch(PDOEXCEPTION $e) 
        {
            print $e->getMessage();
            print_r($stmt);
        }
             
        if($result > 0)
        {
            $dbUser = $result["Username"];
            $dbPw = $result["Password"];
            
            if($username == $dbUser && password_verify($password, $dbPw))
            {
            $this->UserID = $result["UserID"]; 
            $this->Username = $result["Username"];
            $this->First_Name = $result["First_Namername"];
            $this->Last_Name = $result["Last_Name"];
            $this->Zip = $result["Zip"];
            $this->City = $result["City"];
            $this->Email = $result["Email"];
            $this->Phone_Number = $result["Phone_Number"];
            $this->Profile_Image = $result["Profile_Image"];
            return true;
    
            }else {
               return false;
            }       
        }
    }

    public function userID($username) {
        try{
            $stmt = $this->conn->prepare("SELECT UserID FROM Users WHERE username = '$username';");
            $stmt->execute(); 
            $result = $stmt->fetchColumn(); 

            
            return $result;
    
        } catch(PDOEXCEPTION $e) 
        {
            print $e->getMessage();
            print_r($stmt);
        }
    }

    public function username($id) {
        try{
            $stmt = $this->conn->prepare("SELECT Username FROM Users WHERE UserID = '$id';");
            $stmt->execute(); 
            $result = $stmt->fetchColumn(); 

            
            return $result;
    
        } catch(PDOEXCEPTION $e) 
        {
            print $e->getMessage();
            print_r($stmt);
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function upload($userID, $image, $title, $description) {
        try{
            //try and store user credentials in database
            $stmt = $this->conn->prepare(("INSERT INTO Posts (UserID, Picture, Title, Description, 
            Uploaded_At) VALUES ('$userID', '$image', '$title', '$description', now());"));
            
            if($stmt->execute()){
                exit("<script type='text/javascript'>document.location.href='{$URL}';</script>");
            }
            else{
                echo "\nPDOStatement::errorInfo():\n";
                $arr = $stmt->errorInfo();
                print_r($arr);
            }
        }catch (PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }
    }

    public function apiUpload($userID, $image, $title, $description) {
        try{
            //try and store user credentials in database
            $stmt = $this->conn->prepare(("INSERT INTO Posts (UserID, Picture, Title, Description, 
            Uploaded_At) VALUES ('$userID', '$image', '$title', '$description', now());"));
            $stmt->execute();   
            
        }catch (PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }
    }
    
    public function getUploads() {
		try {
            $stmt = $this->conn->prepare("SELECT Picture, Username, First_Name, Last_Name, Title, Description, Uploaded_At FROM Users, Posts WHERE Users.UserID = Posts.UserID ORDER BY Uploaded_At;");
            //$stmt = $this->conn->prepare("SELECT * FROM Posts;");
            $stmt->execute();
            $pictures = $stmt->fetchAll();
        
        
            if ($pictures) {
                //print_r($pictures);
                return $pictures;
            }
        }catch (PDOException $exception)
        {
            return -1;
            echo "Error: " . $exception->getMessage();
        }
    }

    public function getCurrentUser($userID) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE userid = '$userID';");
            $stmt->execute();
            $response = $stmt->fetchObject();
            $info = get_object_vars($response); 

            return $info;
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return null;
        }
    }
    
    public function getAllProfiles() {
        try {
            $result = $this->conn->prepare("SELECT * FROM users;");
            $result->execute();
            $users = $result->fetchAll();
            
            return $users;
        }catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return null;
        }
    }

    public function searchUser($char) {
        //$q = $_GET['q'].'%';
        try {
        //$q = $_GET['q'].'%';
        $stmt = $this->conn->prepare("SELECT * FROM Users where first_name LIKE '$char' OR last_name LIKE '$char' ;");
        $stmt->execute(); 
        $row = $stmt->fetchAll();
        ///

        ///
        return $row;
        } catch (PDOException $exception) {
        echo 'Error: ' . $exception->getMessage();
        return null;
    }
}
    

    /**
     * api stuff
     */

    public function getUsers() {
        // create query
        try {
            $stmt = $this->conn->prepare('SELECT UserID, Username, First_Name, Last_Name, Zip, City, Email, Phone_Number 
            FROM ' . $this->table .';');
            $stmt->execute(); 
            $num = $stmt->rowCount();

            if($num > 0)
            {
                // create array for json 
                $users_arr = array();
                $users_arr['users'] = array(); // assign index 0, as users as key, and array with db info as value

                // while $row contains data
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row); // extract data from db
                    // create user info arr
                    $user_item = array(
                        'user_id' => $UserID,
                        'username' => $Username,
                        'firstName' => $First_Name,
                        'lastName' => $Last_Name,
                        'zip' => $Zip,
                        'city' => $City,
                        'email' => $Email,
                        'phoneNumber' => $Phone_Number
                    );

                    // push each user information into users_arr
                    array_push($users_arr['users'], $user_item);
                }
                echo json_encode($users_arr['users']); // json encode the users_arr and echo to client
            } else {
                echo json_encode(
                    array('message' => 'No users Found')
                );
            } 
            
            } catch (PDOException $exception) {
            echo 'Error: ' . $exception->getMessage();
            
        }
}


    

    public function getImages($username, $userid) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Posts, Users where Posts.UserID = '$userid' AND Users.Username = '$username';");
            $stmt->execute();
            $num = $stmt->rowCount();

            if($num > 0)
            {
                $images_arr = array();
                $images_arr['pictures'] = array(); 
                
                //"data:image/jpeg;base64,".$Picture,
                // any rows exists
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    $image_item = array(
                        'image_id' => $PictureID,
                        'title' => $Title,
                        'description' => $Description,
                        'image' => "data:image/jpeg;base64," . $Picture,
                        'username' => $Username,
                        'userid' => $UserID,
                        'uploaded_at' => $Uploaded_At

                    );
                    array_push($images_arr['pictures'], $image_item); // push items into image_arr
                }
                echo json_encode($images_arr['pictures']); // echo json array to client requesting it.
            
            
            } else {
                echo json_encode(
                    array('message' => 'Could not get images')
                );
            }
            
            } catch (PDOException $exception) {
            echo 'Error: ' . $exception->getMessage();
            
        }

    }

    /**
     * Get the value of First_Name
     */ 
    public function getFirst_Name()
    {
        return $this->First_Name;
    }

    /**
     * Set the value of First_Name
     *
     * @return  self
     */ 
    public function setFirst_Name($First_Name)
    {
        $this->First_Name = $First_Name;

        return $this;
    }

    /**
     * Get the value of Last_Name
     */ 
    public function getLast_Name()
    {
        return $this->Last_Name;
    }

    /**
     * Set the value of Last_Name
     *
     * @return  self
     */ 
    public function setLast_Name($Last_Name)
    {
        $this->Last_Name = $Last_Name;

        return $this;
    }

    /**
     * Get the value of conn
     */ 
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Get the value of Username
     */ 
    public function getUsername()
    {
        return $this->Username;
    }


    /**
     * Get the value of Zip
     */ 
    public function getZip()
    {
        return $this->Zip;
    }

    /**
     * Get the value of City
     */ 
    public function getCity()
    {
        return $this->City;
    }

    /**
     * Get the value of Email
     */ 
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Get the value of Phone_Number
     */ 
    public function getPhone_Number()
    {
        return $this->Phone_Number;
    }

    /**
     * Get the value of Profile_Image
     */ 
    public function getProfile_Image()
    {
        return $this->Profile_Image;
    }

    /**
     * Get the value of UserID
     */ 
    public function getUserID()
    {
        return $this->UserID;
    }
}


