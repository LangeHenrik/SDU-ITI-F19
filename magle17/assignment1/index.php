
<?php

$_SESSON['registerMessage']='Prøv igen, så kan du se blærede billeder';
$_SESSION['loginMessage']='Prøv igen, så kan du se blærede billeder';


require_once 'db_config.php';
try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $preparedLoginCheck = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $preparedGetUsername = $conn->prepare("SELECT * from users WHERE username = :username");
    $prepareInsertUser = $conn->prepare("INSERT INTO users (username, firstname, lastname, zip, city, email, phone, password) 
    VALUES(:username, :firstname,:lastname,:zip,:city,:email,:phone,:password)");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if(isset($_POST["login-username"]) && isset($_POST["login-password"])) {
    $usernameLogin = htmlentities(filter_input(INPUT_POST, "login-username", FILTER_SANITIZE_STRING));
    $passwordLogin = htmlentities(filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_STRING));
    $preparedLoginCheck->bindparam(':username', $usernameLogin);
    $preparedLoginCheck->bindparam(':password', $passwordLogin);
    $preparedLoginCheck->execute();
    $preparedLoginCheck->setFetchMode(PDO::FETCH_ASSOC);
    $result = $preparedLoginCheck->fetchAll();
    if (count($result) == 1) {
        session_start();
        $_SESSION['loggedInUser'] =  $_POST["login-username"];
        $_SESSION['loggedin'] = true;
        header('Location: images.php');
    } else {
      $_SESSION['loginMessage'] = "Prøv igen, så kan du se blærede billeder!";
    }
  }

  if (isset($_POST["register-username"])) {
    $usernameInput = htmlentities(filter_input(INPUT_POST, "register-username", FILTER_SANITIZE_STRING));
    $passwordInput = htmlentities(filter_input(INPUT_POST, "register-password", FILTER_SANITIZE_STRING));
    $frontNameInput = htmlentities(filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING));
    $lastNameInput = htmlentities(filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING));
    $zipInput = htmlentities(filter_input(INPUT_POST, "zip", FILTER_SANITIZE_NUMBER_INT));
    $cityInput = htmlentities(filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING));
    $emailAdressInput = htmlentities(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
    $phoneNumberInput = htmlentities(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING));
    
    $preparedGetUsername->bindparam(':username', $usernameInput);
    $preparedGetUsername->execute();
    $preparedGetUsername->setFetchMode(PDO::FETCH_ASSOC);
    $result = $preparedGetUsername->fetchAll();


    if (count($result) == 1) {
      $_SESSION['registerMessage'] = "EFTERABER! Dit brugernavn er allerede taget! Eller også er adgangskoden for kort";
    }
    else {
      $prepareInsertUser->bindparam(':username', $usernameInput);
      $prepareInsertUser->bindparam(':password', $passwordInput);
      $prepareInsertUser->bindparam(':lastname', $lastNameInput);
      $prepareInsertUser->bindparam(':firstname', $frontNameInput);
      $prepareInsertUser->bindparam(':zip', $zipInput);
      $prepareInsertUser->bindparam(':city', $cityInput);
      $prepareInsertUser->bindparam(':phone', $phoneNumberInput);
      $prepareInsertUser->bindparam(':email', $emailAdressInput);
      $success=$prepareInsertUser->execute();
      if($success){
        $_SESSION['registerMessage'] = "Dine bruger-oplysninger er blevet gemt. Log ind ovenfor og se på de blærede billeder";
      }else{
        $_SESSION['registerMessage'] = "Noget gik galt. Kontakt ham med de blærede billeder for at få hjælp.";
      }
    }
  }



$conn=null;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlæredeBilleder</title>
  </head>
  <body>
    <div class="base">
      <h1>Dét Sgu Da BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor intet er privat og alt er lovligt</h2>
      <div class="form-container login">
          <form class="form-classic" method="POST">
              <fieldset class="fieldset-classic">
                  <legend>Log ind for at se nogle BlæredeBilleder</legend>
                  <label for="username"> Brugernavn</label>
                  <br>
                  <input type="text" id="username" name="login-username">
                  <br>
                  <label for="password"> Adgangskode</label>
                  <br>
                  <input type="password" id="password" name="login-password">
                  <br>
                  <br>
                  <input class="submit-button" type="submit" id="login" value="Login" name="login">
                  <div class="messagebox">
                    <p></p>
                    <?php 
                    $_SESSION['loginMessage']='Prøv igen, så kan du se blærede billeder';
                    echo''.$_SESSION['loginMessage'];
                    $_SESSION['loginMessage'] = ' ';
                    ?>
                  </div>
              </fieldset>
          </form>
      </div>
      <div>
          <p class="inbetweener">
              <b>Eller</b>
          </p>
      </div>
      <div class="form-container register">
            <form class="form-classic" method="POST">
                <fieldset class="fieldset-classic">
                        <legend>Opret dig som bruger for at se nogle BlæredeBilleder</legend>
                        <label for="firstname">Fornavn</label>
                        <br>
                        <input type="text" id="firstname" name="firstname">
                        <br>
                        <label for="lastname">Efternavn</label>
                        <br>
                        <input type="text" id="lastname" name="lastname">
                        <br>
                        <label for="zip">Postnummer</label>
                        <br>
                        <input type="text" id="zip" name="zip">
                        <br>
                        <label for="city">By</label>
                        <br>
                        <input type="text" id="city" name="city">
                        <br>
                        <label for="email">E-mail</label>
                        <br>
                        <input type="text" id="email" name="email">
                        <br>
                        <label for="phone">Telefon</label>
                        <br>
                        <input type="text" id="phone" name="phone">
                        <br>
                        <label for="register-username"> Brugernavn</label>
                        <br>
                        <input type="text" id="register-username" name="register-username">
                        <br>
                        <label for="register-password"> Adgangskode</label>
                        <br>
                        <input type="password" id="register-password" name="register-password">
                        <br>
                        <label for="passwordSecond"> Adgangskode igen</label>
                        <br>
                        <input type="password" id="passwordSecond" name="register-passwordSecond">
                        <br>
                        <br>
                        <input type="submit" class="submit-button" id="register" value="Opret Bruger" name="register">
                        <div class="messagebox">
                            <p></p>
                            <?php 
                            $_SESSION['registerMessage']='Noget gik galt. Kontakt ham med de blærede billeder for at få hjælp.';
                            echo''.$_SESSION['registerMessage'];
                            $_SESSION['registerMessage'] = ' ';?>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>
    <footer class="footer">
      <p>Copyright: none</p>
      <p>Terms of use: none</p>
    </footer>
  </body>
</html>
