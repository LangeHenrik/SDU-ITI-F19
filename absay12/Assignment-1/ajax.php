<?php
  session_start();
  try {
    require_once 'include/config.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }
    $sqlStmt = $conn->prepare("SELECT user_name, front_name, last_name, zip_code, city, phone_number, email_adress FROM person");
    $sqlStmt->execute();
    $sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $sqlStmt->fetchAll();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
   ?>
<!DOCTYPE html> 
<html lang="da"> 
<head> 
  <meta charset="utf-8"> 
  <title>Absay12 - Users</title> 
  <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/grid.css"> 
  <link rel="stylesheet" href="css/core.css"> 
  <link rel="stylesheet" href="css/rwd.css"> 
<?php include 'include/config.php' ?>
</head> 
<body> 
<!--Navigation-->
<div class="row col100">
  <div><?php include 'include/nav.php';?></div>
</div> 

<div class="after_nav">
    <h1>Ajax Call.</h1>

      <div id="demo">
      <h2>The XMLHttpRequest Object</h2>
      <button type="button" onclick="loadDoc()">Change Content</button>
      </div>

      <script>
      function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
            this.responseText;
          }
        };
        xhttp.open("GET", "ajax_info.txt", true);
        xhttp.send();
      }
      </script>
    </div>



</body> 
</html>