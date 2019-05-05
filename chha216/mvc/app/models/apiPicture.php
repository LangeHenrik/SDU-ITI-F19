<?php
//require_once "../core/Database.php";
class apiPicture extends Database
{
    public function getAllPictures()
    {
        $sql = $this->conn -> prepare("SELECT * from pictures order by image_id desc");
        $sql -> execute();
        if ($sql->rowCount() > 0) {
            $pictures = $sql->fetchall(PDO::FETCH_NAMED);
            return $pictures;
        }
    }
    public function getById($id)
    {
        $sql = $this->conn -> prepare("SELECT * from pictures Where idus = :id order by image_id desc");
        $sql -> bindParam(':id', $id);

        $sql -> execute();
        $pictures = $sql->fetchall(PDO::FETCH_NAMED);
				/*$i = 1;
				$json ='[';
				foreach($pictures as $row) {

			          			$suser['image_id'] = $row['image_id'];
			                $suser['title'] = $row['title'];
			          			$suser['description'] = $row['description'];
											$suser['image'] = $row['image'];
			          			if ($i == $sql->rowCount()){
			          				$json = $json.json_encode($suser);
			          			}
			          			else{
			          			$json = $json.json_encode($suser).',';
			          		}
			          			$i = $i + 1;

			          		}
			          $json = $json.']';*/
								$json = json_encode($pictures);
        return $json;
    }


    public function uploadPicture($id)
    {
			$newfile = json_decode($_POST['json'], true);
				$image = $newfile['image'];
				$title = htmlspecialchars($newfile['title'], ENT_QUOTES);
				$username = $newfile['username'];
				$password = $newfile['password'];
				$description = htmlspecialchars($newfile['description'], ENT_QUOTES) ;

				$sql = $this->conn -> prepare("SELECT * from users Where user_id = :id");
				$sql -> bindParam(':id', $id);
				$sql -> execute();
				$user = $sql -> fetch(PDO::FETCH_ASSOC);
				if ($user == true) {
						$pwdcheck = password_verify($password, $user['password']);
						if ($pwdcheck == false) {
								//header("Location: ../login.php?error=wrongpwd");
								exit();
						} elseif ($pwdcheck == true) {



                $stmt = $this->conn->prepare("INSERT INTO pictures(idus, username, title, description, image)
				VALUES (:idus, :user, :title, :des, :bl);");
                $stmt->bindParam(':idus', $id);
                $stmt->bindParam(':user', $username);
                $stmt->bindParam(':bl', $image);
                $stmt->bindParam(':des', $description);
                $stmt->bindParam(':title', $title);
                $stmt -> execute();

								$sql = $this->conn -> prepare("SELECT MAX(image_id) FROM pictures where idus = :id;");
								$sql -> bindParam(':id', $id);
								$sql -> execute();
								$img_id = $sql -> fetch(PDO::FETCH_NAMED);
								$image_id['image_id'] = $img_id['MAX(image_id)'];
								$json = json_encode($image_id);
								echo $json;


							}
            }
        }
}
