<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['message'] = "You must log in first";
    header('location: index.php');
  }

  if (isset(($_POST["logout"]))) {
    unset($_SESSION['email']);
    session_destroy();
	header('Location: index.php');
  }

?>

<html>

<head>


</head>

<body>

<div id="menu">
        	<h1> Logged in as <?php if (isset($_SESSION['email'])) {echo 'Logged in as: ' . $_SESSION['email'];} ?>
            	<a href="./users.php">Users</a>
                <a href="./pictures.php"> Pictures </a>
                <a href="./index.php" action="<?php session_destroy(); unset($_SESSION['email']); ?>" >Log out</a>
            </h1>
        </div>



</body>

</html>
