<?php
class User extends Database {

	public function create(){
		if (isset($_POST['signup_submit'])) {

			$uid = $_POST['username'];
		  $email = $_POST['email'];
		  $zip = $_POST['zip'];
		  $city = $_POST['city'];
		  $phoneN = $_POST['phonenumber'];
		  $pwd = $_POST['password'];
		  $repwd = $_POST['rep_password'];
		  if (empty($uid) ||empty($email) ||empty($pwd) ||empty($repwd)) {
		    //header("Location: ../signup.php?error=emptyfields&username=".$uid."&email=".$email);
		    //exit();
		  }
		  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/",$uid)) {
		    //header("Location: ../signup.php?error=invalidEmail&invalidusername");
		    //exit();
		  }
		  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    //header("Location: ../signup.php?error=invalidEmail&username=".$uid);
		    //exit();
		  }
		  elseif (!preg_match("/^[a-zA-Z0-9]*$/",$uid)) {
		    //header("Location: ../signup.php?error=invalidusername&email=".$email);
		    //exit();
		  }
		  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$firstN)) {
		    //header("Location: ../signup.php?error=invalidname");
		    //exit();
		  }
		  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$lastN)) {
		    //header("Location: ../signup.php?error=invalidname");
		    //exit();
		  }
		  elseif (!preg_match("/^[0-9]*$/",$zip)) {
		    //header("Location: ../signup.php?error=invalidzip");
		    //exit();
		  }
		  elseif (!preg_match("/^[a-zA-ZÆØÅæøå]*$/",$city)) {
		    //header("Location: ../signup.php?error=invalidcity");
		    //exit();
		  }
		  elseif (!preg_match("/^[0-9]*$/",$phoneN)) {
		    //header("Location: ../signup.php?error=invalidphoneNr");
		    //exit();
		  }
		  elseif ($pwd !== $repwd) {
		    //header("Location: ../signup.php?error=passwordcheck&username=".$uid."&email=".$email);
		    //exit();
		  }
		  else {

		    $stmt = $this->conn->prepare("SELECT username from users where username = :username");
		    if (!$stmt) {
		      //header("Location: ../signup.php?error=sqlerror");
		      //exit();
		    }
		    $stmt->bindParam(':username', $uid);
		    $stmt->execute();

		    if ($stmt->rowCount() >= 1) {
		      //header("Location: ../signup.php?error=usernameInUse&email=".$email);
		      //exit();
		    }
		  }
		    try{
		    $stmt = $this->conn->prepare("INSERT INTO users (username, emailUsers, city, zip, numb, password)
		    VALUES (:uid, :email, :city, :zip, :numb, :password)");
		    if (!$stmt) {
		      //header("Location: ../signup.php?error=sqlerror");
		      //exit();
		    }

		    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
		    $stmt->bindParam(':zip', $zip);
		    $stmt->bindParam(':city', $city);
		    $stmt->bindParam(':phoneN', $phoneN);
		    $stmt->bindParam(':username', $uid);
		    $stmt->bindParam(':password', $hashedpwd);
		    $stmt->bindParam(':email', $email);
		    $res = $stmt->execute();
		    if (!$res){
		      //header("Location: ../signup.php?error=sqlerror");
					 echo 'failure res';
					//exit();
		    }
		    else {
		        //header("Location: ../signup.php?signup=success");
							//echo 'succses1';
		        //exit();
		    }
		  }
		  catch(PDOException $e){
				 echo 'failure';
				//header("Location: ../signup.php?error=sqlerror");
		    //exit();
		  }
			//echo 'succses2';


		}
		else{
		 // header("Location: ../signup.php");
		 echo 'failure';

		  //exit();
		}
	}

public function login_user(){
	if (isset($_POST['login_submit'])) {


      $uid = $_POST['username'];
      $pwd = $_POST['password'];

      if (empty($uid)|| empty($pwd)) {
          //header("Location: ../login.php?error=emptyfields");
        //  exit();
      } else {
          $stmt = $this->conn->prepare("SELECT * from users where username = :username");
          if (!$stmt) {
              //header("Location: ../login.php?error=sqlerror");
              //exit();
          } else {
              $stmt->bindParam(':username', $uid);
              $stmt->execute();
              $user = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($user == true) {
                  $pwdcheck = password_verify($pwd, $user['password']);
                  if ($pwdcheck == false) {
                      //header("Location: ../login.php?error=wrongpwd");
                      //exit();
                  } elseif ($pwdcheck == true) {
                      //session_start();
                      $_SESSION['user_id']= $user['user_id'];
                      $_SESSION['username']= $user['username'];
											$_SESSION['logged_in'] = true;
											//header("Location: ../index.php?login=success");

                  } else {
                      //header("Location: ../login.php?error=wrongpwd");

                  }
              } else {
                  //header("Location: ../login.php?error=NoUser");

              }
          }
      }
      //$conn = null;
  } else {
		return null;

  }
}
public function getuser($id){
	if ($id === 0){
		$sql = $this->conn->prepare('SELECT * from users');
		$sql -> execute();
		$users = $sql -> fetchall(PDO::FETCH_NAMED);
		$json = '[';
		$i=1;
		foreach ($users as $user) {

			$suser['user_id'] = $user['user_id'];
			$suser['username'] = $user['username'];
			if ($i == $sql->rowCount()){
				$json = $json.json_encode($suser);
			}
			else{
			$json = $json.json_encode($suser).',';
		}
			$i = $i + 1;

		}
$json = $json.']';
return $json;
}
else {
	$sql = $this->conn->prepare('SELECT * from users where user_id = :userid');
	$sql -> bindParam(':userid', $id);

	$sql -> execute();

	$user = $sql -> fetchall(PDO::FETCH_NAMED);

	$suser['user_id'] = $user[0]['user_id'];
	$suser['username'] = $user[0]['username'];
	$json = '['.json_encode($suser).']';

 return $json;

}
}}
