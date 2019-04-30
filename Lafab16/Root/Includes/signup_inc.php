<?php
// Did they click the submit buttom
if (isset($_POST['signup-submit'])) {

include 'dbh_inc.php';

//Fecht the information from the form
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $numb = $_POST['numb'];
  $password = $_POST['pwd'];
  $password_repeat = $_POST['pwd-repeat'];

//Error handlers
  //Is eny field empty? username, email password or password_repeat. the rest is not a nessesarity
  if (empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    //We send the !empty fileds to the signup.php site. Only email and username .. not password ofc.
    exit();
    //If the user made a mistake, we dont want to continue the code after this
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
    // If both the email and the username is invalid ...
    header("Location: ../signup.php?error=invalidmailuid");

    exit();
    //If the user made a unvalid email and a unvalid username, we dont want to continue the code after this
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //If the email is invalid
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    //We send the username back to the signup.php site
    exit();
    //If the user made a unvalid email, we dont want to continue the code after this
  }

  else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) { //If the username is valid - preg_match is the search pattern we use
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    //We send the email back to the signup.php site
    exit();
    //If the user made a unvalid Username, we dont want to continue the code after this
  }

  else if($password !== $password_repeat) {
    header("Location: ../signup.php?error=passwordchech&uid=".$username."&mail=".$email);
    //We send the username and the email back to the signup.php site
    exit();
  }

  else {
    //If the username already is in the dB
    $sql = "SELECT uidusers FROM users WHERE uidusers=?"; //THe ? is a placeholder
    $stmt = $connect->prepare($sql);

    if (!$stmt) { //Is there an error in the sql statement
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }

    else {
      $stmt->bindParam(1, $username);
      //The "s" is for string and tells that the placeholder is a string
      $stmt->execute();
      //executing the sql statement

      if($stmt->rowCount() > 0) { // If the username already exist the number of rows returned will be one.
        header("Location: ../signup.php?error=usernametaken&mail=".$email);
        exit();
      }

      else { //The actual signup ..
      $sql = "INSERT INTO users(uidusers, emailUsers, city, zip, numb, pwd) VALUES (?, ?, ?, ?, ?, ?)"; //THe ? is placeholders
      $stmt = $connect->prepare($sql);

        if (!$stmt) { //Is there an error in the sql statement
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          //Hashed password

          $stmt->bindParam(1, $username);
          $stmt->bindParam(2, $email);
          $stmt->bindParam(3, $city);
          $stmt->bindParam(4, $zip);
          $stmt->bindParam(5, $numb);
          $stmt->bindParam(6, $hashedPwd);
          //Bind the variables 1, 2, 3, 4, 5 and 6 to the placeholders
          $stmt->execute();
          //executing the sql statement
          header("Location: ../index_new.php?signup=success");
          exit();
        }
      }
    }
  }
  //Closing the sql connection
  $connect = null;
}
else { //if the user try to enter the signup page without entering the signup button
  //We send them back to the signup page
  header("Location: ../signup.php");
  exit();
}

//We only need to close the php if we want to include html code
