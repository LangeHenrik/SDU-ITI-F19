<?php

class postImage extends Database {

    public function post ($user, $userID) {
        // find free user_id
        $stmt1 = $this->conn->prepare("SELECT content.image_id FROM rafha13.content");

		$stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
		$postid = $stmt1->fetchAll();
        $id = 1;
        $usedids = [];

        foreach ($postid as $tmp) :
            array_push($usedids, $tmp['image_id']);
        endforeach;

        while (in_array($id, $usedids)) {
            $id++;
        }

        //decode json
        $obj = json_decode($_POST['json']);

        // check if username and password matches!

        $stmt2 = $this->conn->prepare("SELECT siteUser.username, siteUser.user_Password FROM rafha13.siteUser WHERE user_id = :userid");	
			
        $stmt2->bindParam(':userid', $userID);
			
		$stmt2->execute();
		$stmt2->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt2->fetchAll();
		
		if ($user == null) {
            // no matching user found.
            return 0;
		} else {
            $password1 = $obj->password;
            $username1 = $obj->username;
            $password2 = $user[0]['user_Password'];
            $username2 = $user[0]['username'];

			if (password_verify($password1, $password2) && $username1 == $username2) {
                // password and username is accepted!
                // create post
                $type = substr($obj->image, 5, 10);
                $image = substr($obj->image, 23);


                echo 'Type: ' . $type;
                echo '</br>';
                echo 'Image: ' . $image;
                
                                
                $stmt3 = $this->conn->prepare("INSERT INTO rafha13.content (image, post_img_type, post_user, title, description, image_id) VALUES (:image, :type, :user, :title, :description, :postid)");
        
                $stmt3->bindParam(':postid', $id);
                $stmt3->bindParam(':type', $type); 
                $stmt3->bindParam(':image', $image);	
                $stmt3->bindParam(':title', $obj->title);
                $stmt3->bindParam(':description', $obj->description);
                $stmt3->bindParam(':user', $username1);	
                
                $stmt3->execute();

			} else {
                // password or username did not match...
                return 0;
			}
		}

        return $id;
    }

    public function get ($user, $userID) {
        // brug userID til at finde brugeren!

        $stmt1 = $this->conn->prepare("SELECT username FROM rafha13.siteUser WHERE siteUser.user_id = :userid");

        $stmt1->bindParam(':userid', $userID);
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
        $username = $stmt1->fetchAll();

        //return $username[0]['username'];
        
        $stmt = $this->conn->prepare("SELECT image_id, title, description, image FROM rafha13.content WHERE content.post_user = :username");
        
        $stmt->bindParam(':username', $username[0]['username']);
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = [];
        $images = $stmt->fetchAll();

        //return $images;
        
        foreach ($images as $tmp) :
            array_push($result, $tmp);
        endforeach;

        //return $result;
        /*
        for ($i = 0 ; $i < sizeof($result) ; $i++) {
            $result[$i]['image'] = 'data:image/jpeg;base64,' . $result[$i]['image'] ;
        }
        */

        $json = json_encode($result);

        return $json; 
    }

}
?>

