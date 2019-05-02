<?php
class Picture extends Database {

	public function getAllPictures(){
		$sql 										= "SELECT * FROM photo";
		$stmt 									= $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function upload($header, $description, $imgData) {
		$_SESSION['imgMsg'] 		= '';
		if (isset($imgData) && isset($imgType)) {
			$imageData						= base64_encode(file_get_contents($imgData));
			$imageType						= $imgType;
			$user 								= $_SESSION['username'];
			$sql 									= "INSERT INTO photo (photo_image, photo_text, photo_header, photo_user) VALUES (:picture, :description, :header, :user)";

			if (substr($imageType, 0, 5) == "image") {
				$stmt 							= $this->conn->prepare($sql);
				$stmt->execute(
					array(
						'picture' 			=> $imageData,
						'description' 	=> $description,
						'header'				=> $header,
						'user'					=> $user
					)
				);
				return true;
			} else {
				$_SESSION['imgMsg'] = 'That is not an image!';
			}

		} else {
			$_SESSION['imgMsg'] 	= 'Remember to insert an image!';
		}
	}

	public function getAllPicturesSpecific($username) {
		echo "string";
		$sql 										= "SELECT * FROM photo WHERE photo_user = :username";
		$stmt 									= $this->conn->prepare($sql);
		$stmt->execute(
			array(
				'username'					=> $username
			)
		);
		$pictures = $stmt->fetchAll();

		return $pictures;
	}
}