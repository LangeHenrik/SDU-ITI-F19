<?php
class Signup extends Database {

  public function register($username, $email, $name, $password, $password2, $phone, $zip, $city) {
    $_SESSION['count'] = 0;
    if (isset($username) && isset($email) && isset($name) &&
        isset($password) && isset($password2) && isset($phone) &&
          isset($zip) && isset($city)) {

          // Check username: checks if the username is empty and nothing else.
          $username 					= htmlentities(filter_var($username),FILTER_SANITIZE_STRING);
          $email 							= htmlentities(filter_var($email),FILTER_SANITIZE_EMAIL);
          $name 							= htmlentities(filter_var($name),FILTER_SANITIZE_STRING);
          $password 					= htmlentities(filter_var($password),FILTER_SANITIZE_STRING);
          $password2 					= htmlentities(filter_var($password2),FILTER_SANITIZE_STRING);
          $phone 							= htmlentities(filter_var($phone),FILTER_SANITIZE_NUMBER_INT);
          $zip								= htmlentities(filter_var($zip),FILTER_SANITIZE_STRING);
          $city 							= htmlentities(filter_var($city),FILTER_SANITIZE_STRING);

          if ($password === $password2) {
            $sql 							= "SELECT * FROM login WHERE login_username = :username";
            $stmt 						= $this->conn->prepare($sql);
            $stmt->execute(
              array(
                'username' 		=> $username,
              )
            );

            $_SESSION['count'] = $stmt->rowCount();

            if ($_SESSION['count'] > 0) {
              $_SESSION['message'] = "Username already in use";
            } else {
              // Create user
              // Hashing password using md5(password)
              $sql 							= "INSERT INTO login (login_username, login_email, login_name, login_phone,
                                    login_zip, login_city, login_password) VALUES (:username, :email, :name,
                                      :phone, :zip, :city, :password)";
              $stmt 						= $this->conn->prepare($sql);

              $stmt->execute(
                array(
                  'username' 		=> $username,
                  'email' 			=> $email,
                  'name' 				=> $name,
                  'password' 		=> password_hash($password, PASSWORD_DEFAULT),
                  'phone' 			=> $phone,
                  'zip' 				=> $zip,
                  'city' 				=> $city
                )
              );
            }
          } else {
            // Failed to create user
            $_SESSION['message'] = "The two passwords do not match!";
          }
  } else {
    // Failed to create user
    $_SESSION['message'] 				= "Please enter all fields!";
  }
  }
}

?>
