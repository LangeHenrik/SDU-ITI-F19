<?php

class Picture extends Database {

	public $picture_id;
	public $picture;
	public $user;
	public $header;
	public $description;

	public function getPictures() {
		$pics = array();
		$st = $this->conn->prepare("SELECT picid, picture, user, header, description FROM picture LIMIT 20;");
		$results = array();
		if ($st->execute()) {
			while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
				$results[] = $row;
			}
		}
		foreach($results as $result) {
			$pic = new Picture();
			$pic->picture_id = $result['picid'];
			$pic->picture = $result['picture'];
            $pic->user = $result['user'];
            $pic->header = $result['header'];
            $pic->description = $result['description'];
            array_push($pics, $pic);
       }
	   return $pics;
	}

	public function apiUpload($picture, $user_id, $header, $desc) {
		$username = $this->apiGetUsername($user_id);

		$st = $this->conn->prepare("INSERT INTO picture(picture, user, header, description)
			VALUES(:picture_file, :person, :title, :description);");

		$st->bindparam(':picture_file', $picture);
		$st->bindparam(':person', $username);
		$st->bindparam(':title', $header);
		$st->bindparam(':description', $desc);
		$st->execute();

		$pic_id = $this->conn->lastInsertId();

		return $pic_id;
	}

	public function apiGetPicturesFromUser($userid) {
		$username = $this->apiGetUsername($userid);

		//$st = $this->conn->prepare("SELECT picid AS image_id, header AS title, description, picture AS image FROM picture WHERE user = :username;");
		$st = $this->conn->prepare("SELECT picture AS image, header AS title, description FROM picture WHERE user = :username;");

		$st->bindParam(':username', $username);
        $results = array();

        if ($st->execute()) {
			while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
				$results[] = $row;
			}
        }
        return $results;
    }

	private function apiGetUsername($userid) {
		$st = $this->conn->prepare("SELECT username FROM user WHERE userid = :userid;");

		$st->bindparam(':userid', $userid);
		$st->execute();

		$st->setFetchMode(PDO::FETCH_ASSOC);
		$result = $st->fetchAll();
		$username = $result[0]['username'];

		return $username;
	}
}
