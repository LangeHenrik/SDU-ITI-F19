<?php
  require_once 'dbconfig.php';

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $usernamer = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $passwordr = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $repeatpassword = filter_var($_POST['repeatpassword'], FILTER_SANITIZE_STRING);
    $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($_POST['phonenumber'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);

    $regex_Username = "/^([A-Za-z0-9]){1}([A-z0-9]|[-_]){0,19}$/";
    $regex_Password = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\S{8,})/";
    $regex_Name = "/^[A-Z]([a-z]{0,99})$/";
    $regex_LastName = "/^[A-Z]([a-z]{0,99})$/";
    $regex_Email = "/(^([A-z]+[.]?[A-z]+)+@([A-z]+[.]?[A-z]+)+[.][a-z]{2,5}$)/";
    $regex_Phone = "/^[+][0-9]{8,30}$/";
    $regex_Zip = "/^[0-9]{4}$/";
    $regex_City = "/^(?=.[a-zA-Z ]{1,99}$)(^([A-Z]([a-z]*)+\s?)+$)/";

    $username_match = preg_match($regex_Username, $usernamer);
    $password_match = preg_match($regex_Password, $passwordr);
    $name_match = preg_match($regex_Name, $firstname);
    $lastname_match = preg_match($regex_LastName, $lastname);
    $email_match = preg_match($regex_Email, $email);
    $phone_match = preg_match($regex_Phone, $phonenumber);
    $zip_match = preg_match($regex_Zip, $zipcode);
    $city_match = preg_match($regex_City, $city);
    $username_exists;
    $email_exists;

    if ($passwordr === $repeatpassword) {
      $repet_password_match = 1;
      $passwordHash = password_Hash($passwordr, PASSWORD_DEFAULT);
    } else {
      $repet_password_match = 0;
    }

    if ($username_match && $password_match && $repet_password_match && $name_match && $lastname_match && $email_match && $phone_match && $zip_match && $city_match){

      require_once 'dbconfig.php';

      try {
      			$conn = new PDO("mysql:host=$servername;dbname=$dbname",
      			$username,
      			$password,
      			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


      			$check_username = $conn->prepare("SELECT user_username FROM users WHERE user_username = :username;");

      			$check_username->bindParam(':username',$usernamer);
      			$check_username->execute();
      			$check_username->setFetchMode(PDO::FETCH_ASSOC);
      			$result = $check_username->fetchAll();
      			if (!empty($result)){
      				$username_match=false;
      			}

        $check_email = $conn->prepare("SELECT user_email FROM users WHERE user_email = :email;");
        $check_email->bindParam(':email', $email);

        $check_email->execute();
        $check_email->setFetchMode(PDO::FETCH_ASSOC);
        $result = $check_email->fetchAll();
          if (!empty($result)) {
            $email_match=false;
          }

        if ($username_match && $email_match) {
          $stmt = $conn->prepare("INSERT INTO users(user_username, user_password, user_email, user_phonenumber, user_zipcode, user_firstname, user_lastname, city) VALUES(:username, :password, :email, :phone, :zip, :firstname, :lastname, :city);");

          $stmt->bindParam(':username', $usernamer);
  				$stmt->bindParam(':password', $passwordHash);
  				$stmt->bindParam(':email' ,$email);
  				$stmt->bindParam(':phone', $phonenumber);
  				$stmt->bindParam(':zip', $zipcode);
  				$stmt->bindParam(':firstname', $firstname);
  				$stmt->bindParam(':lastname', $lastname);
  				$stmt->bindParam(':city', $city);

  				$stmt->execute();

  				$conn = null;

          header("Location:../Login.php");
        } else {
          $conn = null;
        }
} catch (PDOException $e) {
			$error = $e->getMessage();
			echo "Error: " . $error;
			$conn = null;

    }
}

?>
