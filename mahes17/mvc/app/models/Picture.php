<?php
class Picture extends Database
{

	public function getAllPictures()
	{
		$sql = "SELECT user, title, description, img_blob, upload_date FROM images ORDER BY upload_date DESC";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function getAllUserPictures()
	{
		$sql = "SELECT user, title, description, img_blob, upload_date FROM images WHERE user = :user ORDER BY upload_date DESC";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user', $_SESSION['user']);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function uploadImage($title, $description)
	{
		if (isset($_FILES['image'])) {
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$image_type = $_FILES['image']['type'];

			$exploded = explode('.', $_FILES['image']['name']);
			$image_type = strtolower(end($exploded));
			$allowed_types = array("jpg", "jpeg", "png", "gif");

			if (in_array($image_type, $allowed_types)) {
				$base64_img = "data:image;base64," . base64_encode(file_get_contents($image_tmp_name));

				$sql = "INSERT INTO images(user, title, description, img_blob, user_id) VALUES(:username, :title, :description, :img_blob, (SELECT user_id FROM users WHERE username = :user));";

				$stmt = $this->conn->prepare($sql);
				$stmt->bindParam(':username', $_SESSION['user']);
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':img_blob', $base64_img);
				$stmt->bindParam(':user', $_SESSION['user']);
				$stmt->execute();

				header('Location: /mahes17/mvc/public/picture');
			}
		}
	}

	public function getUserImagesAPI($user_id)
	{
		$sql = "SELECT img_blob as image, title, description FROM images WHERE user_id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $user_id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function uploadImageFromAPI($image, $title, $description, $user_id)
	{
		$sql = "INSERT INTO images(user, title, description, img_blob, user_id) VALUES((SELECT username FROM users WHERE user_id = 5), :title, :description, :img_blob, :userid)";
		$stmt = $this->conn->prepare($sql);
		//$stmt->bindParam(':user_id', $user_id);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':img_blob', $image);
		$stmt->bindParam(':userid', $user_id);
		$stmt->execute();
		$id = $this->conn->lastInsertId();
		return $id;
	}
}
