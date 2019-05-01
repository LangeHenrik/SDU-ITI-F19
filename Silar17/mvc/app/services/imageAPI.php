<?php 
class imageAPI extends Database {
    public function post() {
        $json = json_decode($_POST['json'], true);
        $username = htmlentities($json['username']);
		$password = htmlentities($json['password']);
		$sql = "SELECT user_username, user_password from silar17.site_user WHERE user_username = ?";
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(1, $username);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if (password_verify($password, $result['user_password'])) {
            $image = htmlentities($json['image']);
            $title = htmlentities($json['title']);
            $comment = htmlentities($json['description']);
            $created = date("Y-m-d H:i:s");
            $likes = 0;
            $image = $json['image'];
            $type = 'image/jpeg';
            $sql_code = "INSERT INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) 
            VALUES (:username, :created , :title, :comment, :likes, :image_type, :image)";
            $stmt = $this->conn->prepare($sql_code);
            
            $stmt->bindParam("username", $username);
            $stmt->bindParam("created", $created);
            $stmt->bindParam("title", $title);
            $stmt->bindParam("comment", $comment);
            $stmt->bindParam("likes", $likes);
            $stmt->bindParam("image_type", $type);
            $stmt->bindParam("image", $image, PDO::PARAM_LOB);
            
            $stmt->execute();

            $sql = "SELECT picture_id as image_id from silar17.picture WHERE picture = ?";
		    $stmt = $this->conn->prepare($sql);

		    $stmt->bindParam(1, $image, PDO::PARAM_LOB);
		    $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $json = new \stdClass();
            $json->image_id = $result['image_id'];
            return json_encode($json, JSON_PRETTY_PRINT);
        }
    }
    public function get($user, $user_id){
        //$sql = "SELECT picture as image, picture_title as title, picture_comment as description
        $sql = "SELECT picture_id as image_id, picture_title as title, picture_comment as description, picture as image
        FROM silar17.picture
		where picture_user = ? and picture_likes < 1";
		$stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $user);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchAll();
        //print_r($array);
        //stripslashes($array[0]['image']);
		return json_encode($array, JSON_PRETTY_PRINT);
        
    }
}

?>