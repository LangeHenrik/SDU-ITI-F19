<?php
class CheckUsername extends Database {
public function check_username($username){
		$sql = "SELECT * FROM silar17.site_user where user_username = ?";
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(1, $username);
		$stmt->execute();
		$result = $stmt->fetch();
		if ($result['user_username' == null]){
			$available = "1";
			return $available;
		} else {
			$available = "0";
			return $available;
		}
    }
}
?>