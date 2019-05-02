<?php
class Api extends Database {

	 public function selectUsers() {
     $users = array();
     $sql   = "SELECT * FROM login ORDER BY login_id";
     $stmt  = $this->conn->prepare($sql);
     $stmt->execute();
     while ($outputData = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $users[$outputData['login_id']] = array(
         'user_id'   => $outputData['login_id'],
         'username'  => $outputData['login_username']
       );
     }
     return json_encode($users);
   }

   public function uploadPicture($image, $title, $description, $username, $password) {
     // First check user validation
     $query       = "SELECT * FROM login WHERE login_username = :username";
     $stmt        = $this->conn->prepare($query);
     $stmt->bindParam('username', $username);
     $stmt->execute();
     $result      = $stmt->fetchAll();

     if (isset($result[0]) && sizeof($result) >= 1 && $result[0]['login_username'] == $username) {
       if (password_verify($password, $result[0]['login_password'])) {
         // Insert a new picture
         $pwordHash = password_hash($password, PASSWORD_DEFAULT);
         $image     = base64_encode(file_get_contents($image));
         $sql       = "INSERT INTO photo (photo_image, photo_text, photo_header, photo_user)
                        VALUES (:image, :title, :description, :username, :password);";

         $stmt      = $this->conn->prepare($sql);
         $stmt->execute(
           array(
             'photo_image'   => $image,
             'photo_header'  => $title,
             'photo_text'    => $description,
             'photo_user'    => $username,
             'photo_pass'    => $pwordHash
           )
         );

         // Return json object with photo_id
         $sql   = "SELECT photo_id FROM photo WHERE photo_header = :title AND photo_text = :description AND photo_user = :username";
         $stmt  = $this->conn->prepare($sql);
         $stmt->execute(
           array(
             'title'        => $title,
             'description'  => $description,
             'username'     => $username
           )
         );
         return json_encode($stmt->fetchall());
       } else {
         return json_encode($stmt->fetchall("Wrong password"));
       }
     } else {
       return json_encode($stmt->fetchall("Wrong username"));
     }
   }

   public function selectPictures($image, $title, $user) {
     $pictures = array();
     $sql   = "SELECT * FROM photo WHERE photo_user = :user ORDER BY photo_id";
     $stmt  = $this->conn->prepare($sql);
     $stmt->bindParam('user', $user)
     $stmt->execute();
     while ($outputData = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $pictures[$outputData['photo_id']] = array(
         'image'   => $outputData['photo_image'],
         'user'  => $outputData['photo_user']
       );
     }
     return json_encode($pictures);
   }
}
