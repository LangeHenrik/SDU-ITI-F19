<?php
class Picture extends Database {

	public function all() {
		$sql = "SELECT * FROM pictures";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $$this->conn->fetchAll();	
	}
}

function postValues($userid, $image, $title,
	$description, $username, $password){
    $database = new Database();
	$conn = $database->getConn();

    $userBool = checkUser($username, $password, $conn);
    $matchBool = matchUsernameAndId($userid, $username, $conn);

   /* echo 'username: ' . $userid;
    echo 'image: ' . $image;
    echo $title;
    echo $description;
    echo $username;
    echo $password;*/

    if($userBool === $matchBool){
        uploadImage($image, $title, $description, $userid, $conn);
    } else{
        echo 'Something went wrong';
    }
}

function uploadImage($blob, $title, $desc, $user_id, $conn){
    $sql2 = 'INSERT INTO images(image, title, description, user_id) VALUES (?, ?, ?, ?);';
    $stmt2 = $conn->prepare($sql2);
    //$user_id_chosen = $user_id[0];
    if(!$stmt2 = $conn->prepare($sql2)){
        echo "SQL statement failed 2";
    } else {
        $blob_decode = base64_decode($blob);
        $stmt2->execute([$blob_decode, $title, $desc, $user_id]);
        $last_id = $conn->lastInsertId();

        $arr = array();
        array_push($arr, $last_id);
        //echo $arr;
        echo '{"image_id": "'. $last_id .'"}';
        return '{"image_id": "'. $last_id .'"}';
        //echo json_encode($last_id);
    }
}

function checkUser($username, $password, $conn){

    $sql_username = "SELECT username FROM users WHERE username = :param_username";
    $stmt1 = $conn->prepare($sql_username);
    if ($conn->prepare($sql_username)) {

        $param_username = $username;
        $stmt1->bindParam(':param_username', $param_username);

        if ($stmt1->execute()) {

            // Store result
            $username_values = $stmt1->fetchAll();
            $got_username = '';
            foreach ($username_values as $_username) {

                $got_username = $_username['username'];
            }
            if ($param_username === $got_username) {

                $sql_password = "SELECT password FROM users WHERE username = :param_username";
                $stmt2 = $conn->prepare($sql_password);
                $stmt2->bindParam(':param_username', $param_username);
                $stmt2->execute();
                $password_values = $stmt2->fetchAll();
                $got_hashed_password = '';
                foreach ($password_values as $hashed_password) {
                    $got_hashed_password = $hashed_password['password'];
                }
                if (password_verify($password, $got_hashed_password)) {

                    return true;
                } else return false;
            }
        }
    }
}

function matchUsernameAndId($user_id, $username, $conn){

    $sql = "SELECT username FROM users WHERE user_id = :param_user_id";
    $stmt = $conn->prepare($sql);
    //print_r($user_id);
    //$user_id_chosen = $user_id[0];
    $stmt->bindParam(':param_user_id', $user_id);
    $stmt->execute();

    $gotUsername = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($gotUsername['username'] !== $username){

                return false;
            } else{

                return true;
            }
}

function fetchImages($userid){
	$img = array();		//create return array
	$images = array();	//create image array
	try {
        //database connection
        $database = new Database;
        $db = $database->getConn();

        //connect to database
        $query = $db->prepare("SELECT * FROM images WHERE user_id = ". $userid); // get $user from the URL given (2 is the id): GET localhost:8080/xx/mvc/public/api/pictures/user/2
        $query->execute();

        $images_size = $query->rowCount();

        //get list of user images
		$images = $query->fetchAll();
        array_push($img, $images, $images_size);
    } catch(Exception $e){
        echo json_encode('Exception in database connection');
	}
	return $img;
}
