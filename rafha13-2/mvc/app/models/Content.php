<?php

class Content extends Database {

    public function loadContent () {
        $stmt = $this->conn->prepare("SELECT image, post_img_type, post_user, title, description FROM rafha13.content");
                
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $content = $stmt->fetchAll();

            //print_r($content[0]);

            print_r($content);

        return $content;    
    
    }
    
    public function loadUsers ($i) {
        $content = $this->loadContent();

        $stmt = $this->conn->prepare("SELECT user_Image, user_img_type FROM rafha13.siteUser WHERE username = :username");
        $stmt->bindParam(':username', $content[$i]["post_user"]);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $userimage = $stmt->fetchAll();


        return $userimage;
    }

   public function createPost () {
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

        //CREATE NEW POST

		$info = getimagesize($_FILES['pickImg']['tmp_name']);
		$type = $info['mime'];
		//$type= htmlentities($_FILES['pickImg']['type']);
		$imagetmp= file_get_contents($_FILES['pickImg']['tmp_name']);

        $stmt = $this->conn->prepare("INSERT INTO rafha13.content (image, post_img_type, post_user, title, description, image_id) VALUES (:image, :type, :user, :title, :description, :postid)");
        
        $stmt->bindParam(':postid', $id);
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':image', $imagetmp, PDO::PARAM_LOB);	
		$stmt->bindParam(':title', $_POST['title']);
		$stmt->bindParam(':description', $_POST['description']);
		$stmt->bindParam(':user', $_SESSION['username']);	
		
        $stmt->execute();

	    header('Location: /rafha13-2/mvc/public/content');
   }
}