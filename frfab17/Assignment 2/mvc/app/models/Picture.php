<?php
class Picture extends Database
{

	public function getAllPictures()
	{
		$sql = "SELECT * FROM pictures ORDER BY upload_date DESC";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function uploadImage($title, $desc)
	{
		if (isset($_FILES['image'])) {
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$image_type = $_FILES['image']['type'];

			$exploded = explode('.', $_FILES['image']['name']);
			$image_type = strtolower(end($exploded));
			$allowed_types = array("jpg", "jpeg", "png", "gif");

			if (in_array($image_type, $allowed_types)) {
				$base64_img = "data:image;base64," . base64_encode(file_get_contents($image_tmp_name));

				$sql = "INSERT INTO pictures(user, title, description, img_blob, user_id) VALUES(:username, :title, :description, :img_blob, (SELECT id FROM users WHERE username = :user));";

				$stmt = $this->conn->prepare($sql);
				$stmt->bindParam(':username', $_SESSION['user']);
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':description', $desc);
				$stmt->bindParam(':img_blob', $base64_img);
				$stmt->bindParam(':user', $_SESSION['user']);
				$stmt->execute();

				header('Location: /frfab17/mvc/public/picture/all');
			}
		}
	}
}
