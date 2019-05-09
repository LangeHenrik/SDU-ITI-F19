<?php
class Comment extends Database {
	public static function getComments($imageId) {
		connect();
		global $connection;
		$entries = array();
		
		
		$stmt = $connection->prepare("SELECT * FROM comments WHERE image_id = ?");
		$stmt->bind_param("i", $imageId);

		$stmt->execute();
		$result = $stmt->get_result();
		$index = 0;
		while($row = $result->fetch_assoc()) {
			$entries[$index] = new stdClass();
			$entries[$index]->id = $row["id"];
			$entries[$index]->text = $row["text"];
			$entries[$index]->userId = $row["user_id"];
			
			$index++;
		}
		
		foreach($entries as $object) {
			$object->user=User::getUser($object->userId);
		}
		
		return $entries;
	}



	public static function submitComment($comment, $imageId, $userId) {
		connect();
		global $connection;    
		
		$stmt = $connection->prepare("INSERT INTO comments (text, image_id, user_id) VALUES (?, ?, ?)");
		
		$stmt->bind_param("sii", $comment, $imageId, $userId);
		
		
		if(!$stmt->execute()) {
			echo $stmt->error;
		}
		
		$stmt->close();
		$connection->close();
	}
	
}