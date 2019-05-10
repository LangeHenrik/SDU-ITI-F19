<?php
class Picture extends Database {

	public function all() {
		$sql = "SELECT * FROM pictures";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $$this->conn->fetchAll();
		
	}


}
