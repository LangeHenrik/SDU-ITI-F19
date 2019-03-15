<?php



if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$usernameOK = false;
$passwordOK = false;


require_once 'config.php';
echo "Hello world";

print_r($_POST);
 // checks if the submitbutton have been pressed and if so, it checks inputs and posts to server.
if (isset($_POST["register"])) {
// Check username: checks if the username is empty and nothing else.
  $username =htmlentities(filter_var($_POST["username"]),FILTER_SANITIZE_STRING);
  $password = htmlentities(filter_var($_POST["password"]),FILTER_SANITIZE_STRING);
  $confirm_password = htmlentities(filter_var($_POST["confirm_password"]),FILTER_SANITIZE_STRING);
  $firsname = htmlentities(filter_var($_POST["firstname"]),FILTER_SANITIZE_STRING);
  $lastname = htmlentities(filter_var($_POST["lastname"]),FILTER_SANITIZE_STRING);
  $zipcode = htmlentities(filter_var($_POST["zipcode"]),FILTER_SANITIZE_STRING);
  $city = htmlentities(filter_var($_POST["city"]),FILTER_SANITIZE_STRING);
  $email = htmlentities(filter_var($_POST["email"]),FILTER_SANITIZE_EMAIL);
  $phone = htmlentities(filter_var($_POST["phone"]),FILTER_SANITIZE_NUMBER_INT);


   if (empty($username)) {
    // enter error handling
    echo "Please fill in username";

  }else {  // If the username is approved then it is prepared for the sql query.

    $sql = "SELECT id FROM users WHERE username = :username"; // query to get the id of users with this username.

    if ($stmt = $conn->prepare($sql)) {
      // bind username to to the statement on line 18.
      $stmt->bindParam(":username", $username, PDO::PARAM_STR);

      if ($stmt->execute()) {
        if ($stmt->rowCount()== 1) {  // if this returns true, it means that there is another user with the same password and can not approve the username.
          echo "This username is already taken.";
        }else {
          echo "Username is approved";
          $usernameOK = true;
        }
      }
      else {
        echo "Something went wrong. Try again.";
      }
    }
    unset($stmt);

  }

  if (empty($password)) {
    echo "Please enter a password";
  }elseif (strlen($password < 8)) {
    echo "Password too short(Must be at least 8 characters)";
  }else {
    echo "Password approved";
  }

  if (empty($confirm_password)) {
    echo "Please enter a password";
  }elseif (strlen($confirm_password < 8)) {
    echo "Password too short(Must be at least 8 characters)";
  }else {
    echo "Password approved";
    if($password == $confirm_password){
      $passwordOK = true;
    }
  }


  $sql = "INSERT INTO users (username, password, firstname, lastname, zipcode, city, email, phonennumber) VALUES (:username, :password, :firstname, :lastname, :zipcode, :city, :email, :phonenumber);";


if ($stmt = $conn->prepare($sql)) {
  // bind parameters from form
  $param_pass = password_hash($password,PASSWORD_DEFAULT);

  $stmt->bindParam(":username",$username,PDO::PARAM_STR);
  $stmt->bindParam(":password",$param_pass,PDO::PARAM_STR);  // Hashing the password for safety
  $stmt->bindParam(":firstname",$firsname,PDO::PARAM_STR);
  $stmt->bindParam(":lastname",$lastname,PDO::PARAM_STR);
  $stmt->bindParam(":zipcode",$zipcode,PDO::PARAM_INT);
  $stmt->bindParam(":city",$city,PDO::PARAM_STR);
  $stmt->bindParam(":email",$email,PDO::PARAM_STR);
  $stmt->bindParam(":phonenumber",$phone,PDO::PARAM_STR);

  if ($stmt->execute()) {
    header("location:index.php");
  }else {
    echo "Something went wrong";
  }

}
unset($stmt);


unset($conn);
}





 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Sign Up</title>
     <link rel="stylesheet" href="/registerStyle.css">
     <!-- <link rel="stylesheet" href=" "> -->

 </head>
 <body>
     <div class="wrapper">

       <h1>Sign up here!</h1>
       <p>Please fill up all the textfields.</p>

       <form  action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

         <div class="row">
           <div class="col_1">
             <label>Username</label>
           </div>
           <div class="col_2">
             <input type="text" name="username" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Password</label>
           </div>
           <div class="col_2">
            <input type="password" name="password" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Confirm password</label>
           </div>
           <div class="col_2">
             <input type="password" name="confirm_password" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Firstname</label>
           </div>
           <div class="col_2">
             <input type="text" name="firstname" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Lastname</label>
           </div>
           <div class="col_2">
             <input type="text" name="lastname" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Zip-code</label>
           </div>
           <div class="col_2">
             <input type="text" name="zipcode" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>City</label>
           </div>
           <div class="col_2">
             <input type="text" name="city" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label> Email</label>
           </div>
           <div class="col_2">
             <input type="email" name="email" value="">
           </div>
         </div>

         <div class="row">
           <div class="col_1">
             <label>Phone</label>
           </div>
           <div class="col_2">
             <input type="tel" name="phone" value="">
           </div>
         </div>

         <div class="submit_button">
           <input type="submit" name="register" value="Sign up!">

         </div>
         <p>I  have an account already! <a href="index.php">Click here!</a></p>
       </form>

    </div>

 </body>
 </html>
