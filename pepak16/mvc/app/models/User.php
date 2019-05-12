<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/core/Database.php';

class User extends Database {
	
	protected $dbConnection;

	public function getUserIdByUsername($username) {
		$this->dbConnection = new Database();
        $sql = 'SELECT user_id FROM user WHERE user_name = :domain_name';
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam(':domain_name', $username);
        $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_NUM);
        return $result[0][0];
	}

	public function fetchAllPosts() {
		$this->dbConnection = new Database();
		$sql = 'SELECT * FROM user_post ORDER BY user_post_time DESC';
		$pdo = $this->dbConnection->getConn();
		$data = $pdo->query($sql);
		$result = $data->fetchAll();
		return $result;
	}

	public function fetchUserPosts($userid) {
		$this->dbConnection = new Database();
		$sql = 'SELECT * FROM user_post WHERE post_by = :post_by ORDER BY user_post_time DESC';
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':post_by', $userid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_NUM);
		return $result;
	}

	function insertUser($un, $pw, $pn, $em, $zc) {
		$this->dbConnection = new Database();
		$sql = 'INSERT INTO user (user_name, user_password, user_phonenumber, user_email, user_zipcode)
				SELECT * FROM (SELECT :domain_name,:domain_pass,:domain_phone,:domain_email,:domain_zipcode) AS tmp
				WHERE NOT EXISTS (SELECT `user_name` FROM user WHERE `user_name` = :domain_name) LIMIT 1';
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':domain_name', $un);
		$stmt->bindParam(':domain_pass', $pw);
		$stmt->bindParam(':domain_phone', $pn);
		$stmt->bindParam(':domain_email', $em);
		$stmt->bindParam(':domain_zipcode', $zc);
		$stmt->execute();
		$count = $stmt->rowCount();

		if ($count == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function insertPost($hd,$dc,$url,$postedbyid) {
		$this->dbConnection = new Database();
		$sql = "INSERT INTO user_post (user_post_time, user_post_header, user_post_description, user_post_url, post_by) VALUES (now(), :domain_header, :domain_desc, :domain_url, :postbyid); SELECT LAST_INSERT_ID();";
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':domain_header', $hd);
		$stmt->bindParam(':domain_desc', $dc);
		$stmt->bindParam(':domain_url', $url);
		$stmt->bindParam(':postbyid', $postedbyid);
		$stmt->execute();
		$lastId = $pdo->lastInsertId();
		return $lastId;
	}

	function getUsers() {
		$this->dbConnection = new Database();
		$sql = "SELECT user_id ,user_name, user_phonenumber, user_email, user_zipcode FROM user";
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$userTableArray = $stmt->fetchAll(PDO::FETCH_NUM);
		return $userTableArray;
	}

	function getHashedPasswordById($userid) {
		$this->dbConnection = new Database();
		$sql = "SELECT user_password FROM user WHERE user_id = :domain_user_id";
		$pdo = $this->dbConnection->getConn();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':domain_user_id', $userid);
		$stmt->execute();
		$userpass = $stmt->fetchAll(PDO::FETCH_NUM);
		return $userpass[0][0];
	}

}
