<?php
  require 'header.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<title>
	Assignment One
	</title>
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link rel="stylesheet" href="style.css"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--meta tag that makes this website scalable on different devices -->


</head>

<body>

	<div class="wrapperscale">
		<article class="articlescaletop">
		<p>
			This website is a place where students on the Diploma in Robottechnology, can upload their day to day experience and just cool stuff they invent through the semesters. <br><br>
			If you are not a student on the Diploma in Robottechnology, feel free to take a look around the website and join us anyway.
		</p>
		</article>
	</div>

	<div class="wrapperscale">
		<article class="articlescaletop">
		<p>
		These people has already joined!
		<!-- af "gallery" of all the users so far -->

    <!-- php echo??  -->
    <?php

    $server_name = "localhost";
    $dB_username = "root";
    $dB_password = "";
    $dB_name = "lafab16";
    $dB_port = "3308";

    $connect = new PDO("mysql:host=$server_name;port=$dB_port;dbname=$dB_name", $dB_username, $dB_password);

        // Show users
        $sql = "SELECT uidusers FROM users";
        $stmt = $connect->prepare($sql);

        if (!$stmt) { // if there is an error in the connection
          header('Location: ../index_new.php?error=connectionerror');
          //Send them back to index_new (home page..)
          exit();
        }
        else {
          $stmt->execute();
          //Execute the statement
          if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

              echo "<p><b> ¤ ".$row['uidusers']."</b></p>";

            }
          }
        }
    ?>
		</p>
		</article>
	</div>



</body>
</html>
