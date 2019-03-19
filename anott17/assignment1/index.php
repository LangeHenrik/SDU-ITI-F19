<?php

  $_SESSION['globalRegisterMsg'] = ' ';

  require_once 'db_config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $getPasswordStmt = $conn->prepare("SELECT 1 FROM person WHERE user_name = :user_name AND password = :password");
    $getUserNameStmt = $conn->prepare("SELECT 1 from person WHERE user_name = :user_name");
    $registerStmt = $conn->prepare("INSERT INTO person (user_name, password, front_name, last_name, zip_code, city, phone_number, email_adress)
                            VALUES(:user_name, :password, :front_name, :last_name, :zip_code, :city, :phone_number, :email_adress)");

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  if(isset($_POST["userNameLogin"]) && isset($_POST["passwordLogin"])) {

    $userNameLogin = htmlentities(filter_input(INPUT_POST, "userNameLogin", FILTER_SANITIZE_STRING));
    $passwordLogin = htmlentities(filter_input(INPUT_POST, "passwordLogin", FILTER_SANITIZE_STRING));

    $getPasswordStmt->bindparam(':user_name', $userNameLogin);
    $getPasswordStmt->bindparam(':password', $passwordLogin);

    $getPasswordStmt->execute();
    $getPasswordStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getPasswordStmt->fetchAll();
    if (count($result) == 1) {
        session_start();
        $_SESSION['userNameGlobal'] =  $_POST["userName"];
        $_SESSION['Login'] = true;
        header('Location: pictures.php');
    } else {
    }
  }


  if (isset($_POST["userName"])) {
    $userNameInput = htmlentities(filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING));
    $passwordInput = htmlentities(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
    $frontNameInput = htmlentities(filter_input(INPUT_POST, "frontName", FILTER_SANITIZE_STRING));
    $lastNameInput = htmlentities(filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING));
    $zipInput = htmlentities(filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT));
    $cityInput = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
    $phoneNumberInput = htmlentities(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING));
    $emailAdressInput = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));


    $getUserNameStmt->bindparam(':user_name', $userNameInput);

    $getUserNameStmt->execute();
    $getUserNameStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getUserNameStmt->fetchAll();

  /*  if (!(count($result) == 1)) {
      $registerStmt->bindparam(':user_name', $userNameInput);
      $registerStmt->bindparam(':password', $passwordInput);
      $registerStmt->bindparam(':last_name', $lastNameInput);
      $registerStmt->bindparam(':front_name', $frontNameInput);
      $registerStmt->bindparam(':zip_code', $zipInput);
      $registerStmt->bindparam(':city', $cityInput);
      $registerStmt->bindparam(':phone_number', $phoneNumberInput);
      $registerStmt->bindparam(':email_adress', $emailAdressInput);

      $registerStmt->execute();
    } else {
      $_SESSION['globalError'] = "Username is already taken.";
    }
    */

    if (count($result) == 1) {
      $_SESSION['globalRegisterMsg'] = "Username is already taken.";
    }
    else {
      $registerStmt->bindparam(':user_name', $userNameInput);
      $registerStmt->bindparam(':password', $passwordInput);
      $registerStmt->bindparam(':last_name', $lastNameInput);
      $registerStmt->bindparam(':front_name', $frontNameInput);
      $registerStmt->bindparam(':zip_code', $zipInput);
      $registerStmt->bindparam(':city', $cityInput);
      $registerStmt->bindparam(':phone_number', $phoneNumberInput);
      $registerStmt->bindparam(':email_adress', $emailAdressInput);
      $registerStmt->execute();
      $_SESSION['globalRegisterMsg'] = "Account created, you can now login.";
    }

    /*$userNameInput = $_POST["userName"];
    $passwordInput = $_POST["password"];
    $frontNameInput = $_POST["frontName"];
    $lastNameInput = $_POST["lastName"];
    $zipInput = $_POST["zip"];
    $cityInput = $_POST["city"];
    $phoneNumberInput = $_POST["phone"];
    $emailAdressInput = $_POST["email"];
    */
  }


  $conn = null;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <script src= "logincheck.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anott17</title>
  </head>
  <body>
    <div class="mainDiv">
      <h1>Welcome to Anott17's website</h1>
      <div class="registerDiv">
        <div class="registerCheckDiv">
          <form class="form-register" onsubmit="return checkFields()" method="post">
            <fieldset class="fieldset-register">
              <legend>Register</legend>
              <label for="userName" style="color: black">User name</label>
              <br>
              <input type="text" name="userName" id="userName" onkeyup="checkFields()" >
              <br>

              <label for="password">Password</label>
              <br>
              <input type="password" name="password" id="password" onkeyup="checkFields()" >
              <br>

              <label for="secondPassword">Reenter password</label>
              <br>
              <input type="password" name="secondPassword" id="secondPassword" onkeyup="checkFields()" >
              <br>

              <label for="frontName" style="color: black">Front name</label>
              <br>
              <input type="text" name="frontName" id="frontName" onkeyup="checkFields()" >
              <br>

              <label for="lastName" style="color: black">Last name</label>
              <br>
              <input type="text" name="lastName" id="lastName" onkeyup="checkFields()" >
              <br>

              <label for="zip">Zip code</label>
              <br>
              <input type="text" name="zip" id="zip" onkeyup="checkFields()" >
              <br>

              <label for="city">City</label>
              <br>
              <input type="text" name="city" id="city" onkeyup="checkFields()" >
              <br>

              <label for="phone">Phone number</label>
              <br>
              <input type="text" name="phone" id="phone" onkeyup="checkFields()" >
              <br>

              <label for="email">Email adress</label>
              <br>
              <input type="text" name="email" id="email" onkeyup="checkFields()" >
              <br>

              <input type="submit" value="Register" name="submit" id="submit">

              <div id ="errorDiv" class="registerErrorDiv">
                <p></p>
                <?php echo''.$_SESSION['globalRegisterMsg'];
                $_SESSION['globalRegisterMsg'] = ' ';?>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

      <div class="loginDiv">
        <form class="form-login" method="post">
          <fieldset class="fieldset-login">
            <legend>Login</legend>
            <label for="userName" style="color: black">User name</label>
            <br>
            <input type="text" name="userNameLogin" id="userNameLogin">
            <br>

            <label for="password" style="color: black">Password</label>
            <br>
            <input type="password" name="passwordLogin" id ="passwordLogin">
            <br>

            <input type="submit" value="Login">
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>
