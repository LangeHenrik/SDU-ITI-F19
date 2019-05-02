<?php
class Image extends Database {
	
	public $name;
	function __construct() {
		require_once "../app/models/User.php";
	}
	
	public static function deleteImage($id) {
		connect();
		global $connection;
		$stmt = $connection->prepare("DELETE FROM images WHERE id = ?");
		$stmt->bind_param("i", $id);
		if(!$stmt->execute()) {
			echo $stmt->error;
		}
		
		$stmt = $connection->prepare("DELETE FROM comments WHERE image_id = ?");
		$stmt->bind_param("i", $id);
		if(!$stmt->execute()) {
			echo $stmt->error;
		}
		
		$stmt->close();
		$connection->close();
	}
	
	public static function uploadImage($title, $description, $path, $user_id = null) {
		connect();
		global $connection;    
		if($user_id === null) {
			$user_id= User::getId($_SESSION["user_name"]);
		}
		$stmt = $connection->prepare("INSERT INTO images (title, description, image_path, user_id) VALUES (?, ?, ?, ?)");
		
		$stmt->bind_param("sssi", $title, $description, $path, $user_id);
		
		
		if(!$stmt->execute()) {
			echo $stmt->error;
		}
		$last_id = $connection->insert_id;
		$stmt->close();
		$connection->close();
		
		
		return $last_id;
	}
	
	public static function imagesInRange($start_i, $amount, $user) {
		connect();
		global $connection;
		$entries = array();
		if(!is_int($user)) {
			
			if($user === null) {
				$stmt = $connection->prepare("SELECT * FROM images limit ?, ?");
				$stmt->bind_param("ii", $start_i, $amount);
			} else {
				$id = User::getId($user);
				$stmt = $connection->prepare("SELECT * FROM images WHERE user_id = ? limit ?, ?");
				$stmt->bind_param("iii", $id, $start_i, $amount);
			}
		} else {
			
			$stmt = $connection->prepare("SELECT * FROM images WHERE user_id = ?;");
			$stmt->bind_param("i", $user);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		$index = 0;
		while($row = $result->fetch_assoc()) {
			$entries[$index] = new stdClass();
			$entries[$index]->id = $row["id"];
			$entries[$index]->imagePath = $row["image_path"];
			$entries[$index]->title = $row["title"];
			$entries[$index]->description = $row["description"];
			$entries[$index]->user = $row["user_id"];
			$entries[$index]->imageDate = $row["date"];
			
			$index++;
		}
		
		foreach($entries as $object) {
			$object->user=User::getUser($object->user);
		}
		
		return $entries;
	}
	
	static function getImage($id) {
		connect();
		global $connection;
		

		$stmt = $connection->prepare("SELECT * FROM images WHERE id = ?");
		$stmt->bind_param("i", $id);
		
		$stmt->execute();
		$result = $stmt->get_result();
		
		$row = $result->fetch_assoc();
			
		$entry = new stdClass();
		$entry->id = $row["id"];
		$entry->imagePath = $row["image_path"];
		$entry->title = $row["title"];
		$entry->description = $row["description"];
		$entry->user = $row["user_id"];
		$entry->imageDate = $row["date"];
		
		
		return $entry;
	}
}