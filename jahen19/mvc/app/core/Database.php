<?php

require_once 'db_config.php';

class Database extends DB_Config {

	public $conn;
    public $status = "disconnected";

	public function __construct() {
		try {

			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
			$this->username,
			$this->password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $status = "connected";

            // create Users table
            $sql = "CREATE TABLE IF NOT EXISTS Users (
            id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(31) NOT NULL,
            password VARCHAR(128) NOT NULL,
            city VARCHAR(128),
            email VARCHAR(128)
            );";
            $this->conn->exec($sql);

            // create Images table
            $sql = "CREATE TABLE IF NOT EXISTS Images (
            id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user VARCHAR(31),
            header VARCHAR(50),
            text LONGTEXT,
            date DATETIME,
            data LONGTEXT
            );";
            $this->conn->exec($sql);

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function __destruct() {
		$this->conn = null;
	}

    public function getImages( $username = false){
        $this->model('Image');
        $images = array();

        if ($username != false) {
            $sql = "SELECT id, data, user, header, text FROM Images WHERE user = '$username' ORDER BY date DESC LIMIT 20";
        } else {
            $sql = "SELECT id, data, user, header, text FROM Images ORDER BY date DESC LIMIT 20";
        }

        try {
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
                foreach($result as $row) {
                    $image = new Image();
                    $image->id = $row["id"];
                    $image->user = $row["user"];
                    $image->header = $row["header"];
                    $image->text = $row["text"];
                    $image->data = $row["data"];
                    array_push($images, $image);
                }
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return $images;
    }

    public function getUsers(){
        $users = array();

        try {
            $sql = "SELECT username, city, email FROM Users;";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
                foreach($result as $row) {
                    $user = new User();
                    $user->name = $row["username"];
                    $user->city = $row["city"];
                    $user->email = $row["email"];
                    array_push($users, $user);
                }
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return $users;
    }

    public function checkUserPassword($username, $password) {
        try {
            $sql = "SELECT username, password FROM Users WHERE username = :username";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() >= 1) {
                return password_verify($password, $result[0]["password"]);
            }
            return false;
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public function createUser($user){

        try {
            $sql = "SELECT username FROM Users WHERE username = :username";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":username", $user->name);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
                // user already exists
                return false;
            } else {
                // create new entry for user
                $sql = "INSERT INTO Users (username, password, city, email) values (:username,:password, :city, :email)";
                $statement = $this->conn->prepare($sql);
                $statement->bindParam(":username", $user->name);
                $statement->bindParam(":password", $user->hashed_password);
                $statement->bindParam(":city", $user->city);
                $statement->bindParam(":email", $user->email);
                $statement->execute();
            }

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    }

    public function insertImage($image){
        try {
            $sql = "INSERT INTO Images (user, header, text, date, data) values (:user, :header, :text, NOW(), :data)";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":user", $image->user);
            $statement->bindParam(":header", $image->header);
            $statement->bindParam(":text", $image->text);
            $statement->bindParam(":data", $image->data);
            $statement->execute();

            // get id of inserted image
            $sql = "SELECT LAST_INSERT_ID()";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            // print_r($result);
            // print_r($statement);
            if ($result) {
                return $result[0][0];
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return NULL;
    }

    public function deleteImage($image_id, $user) {
        try {
            $sql = "DELETE FROM Images WHERE user = :user AND id = :image_id LIMIT 1";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":user", $user);
            $statement->bindParam(":image_id", $image_id);
            $statement->execute();
            return;
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public function getUserCity($username) {
        try {
            $sql = "SELECT city FROM Users WHERE username = :username LIMIT 1";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() >= 1 && ! empty($result[0]['city'])) {
                return $result[0]['city'];
            }
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return false;
    }

    public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}


}
