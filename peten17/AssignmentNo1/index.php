
if (isset($_POST["submit"])) {
if (isset($_POST['username'])  && isset($_POST['password']) ) {
  if ($_POST['username'] === "admin" && $_POST['password'] === "password") {
    echo "Username and password are correct.";
    $_SESSION['login'] = TRUE;
    header('LOCATION:startpage.php');

  } else {
    echo "incorrect login";
    die();
  }
}
}

 ?>


