
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!(isset($_SESSION['loggedInUser'])) || ($_SESSION['loggedin'] !== true)) {
    echo 'You are not logged in!';
    return;
}
if(isset($_POST["logout"])) {
    header('Location: index.php');
    session_destroy();
}
if(isset($_POST["goto-images"])){
    header('Location: images.php');
}
if(isset($_POST["goto-users"])){
    header('Location: users.php');
}

require_once 'db_config.php';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $preparedGetImages=$conn->prepare('SELECT * FROM media where uploaded_by=:userid LIMIT :offset,4');
    $preparedGetInitialImages=$conn->prepare("SELECT * FROM media where uploaded_by=:userid limit 20");
    $preparedGetFileName=$conn->prepare("SELECT media_name FROM media where id=:id");
    $preparedRemoveImage=$conn->prepare("DELETE FROM media where id=:id");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

  $pointer =1;
  $column1 ='';
  $column2 ='';
  $column3 ='';
  $column4 ='';

  $preparedGetInitialImages->bindParam(':userid',$_SESSION["loggedInUser"],PDO::PARAM_INT);
  $preparedGetInitialImages->execute();
  $preparedGetInitialImages->setFetchMode(PDO::FETCH_ASSOC);
  $result=$preparedGetInitialImages->fetchAll();
  foreach($result as $row){
      $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="media/'.$row['media_name'].'"><p>'.$row['description'].'</p><form action="userImages.php" method="post"><input type="hidden" name="image-id" value="'.$row['id'].'"><input type="submit" name="remove-image" value="Slet"></form></div>';
      switch($pointer){
      case 1:
          $column1.=$tmp;
          $pointer++;
          break;
      case 2:
          $column2.=$tmp;
          $pointer++;
          break;
      case 3:
          $column3.=$tmp;
          $pointer++;
          break;
      case 4: 
          $column4.=$tmp;
          $pointer=1;
          break;
      }
  }
}

if(isset($_GET["offset"])){
  if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
      
      $preparedGetImages->bindParam(':offset',$_GET["offset"],PDO::PARAM_INT);
      $preparedGetImages->bindParam(':userid',$_SESSION["loggedInUser"],PDO::PARAM_INT);
      $preparedGetImages->execute();
      $preparedGetImages->setFetchMode(PDO::FETCH_ASSOC);
      $result=$preparedGetImages->fetchAll();
      $preparedGetImages=null;
      
      $columns=array();
      
      if(sizeof($result)==0){
          echo '0';
      }else{
          foreach($result as $row){
              $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="media/'.$row['media_name'].'"><p>'.$row['description'].'</p><form action="userImages.php" method="post"><input type="hidden" name="image-id" value="'.$row['id'].'"><input type="submit" name="remove-image" value="Slet"></form></div>';
              array_push($columns,$tmp);
          }
          echo json_encode($columns);
      }  
  }
}

if(isset($_POST["remove-image"])){
  $imageid=$_POST["image-id"];

  $preparedGetFileName->bindParam(':id',$imageid,PDO::PARAM_INT);
  $preparedGetFileName->execute();
  $preparedGetFileName->setFetchMode(PDO::FETCH_ASSOC);
  $result=$preparedGetFileName->fetch();
  $filename=$result['media_name'];

  $preparedRemoveImage->bindParam(':id',$imageid,PDO::PARAM_INT);
  
  if($preparedRemoveImage->execute()){
    if (file_exists("media/".$filename)) {
      unlink("media/".$filename);
      $removeImageResponse = 'Det blærede billede, '.$filename.', er blevet slettet......';
    } else {
      $removeImageResponse = 'Det blærede billede blev slettet fra din profil, men '.$filename.' kunne ikke slettes fra media mappen.';
    }
  }else{
    $removeImageResponse ='Det blærede billede blev ikke slettet!';
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlæredeBilleder</title>
  </head>
  <body onscroll="monitorScroll()">
    <div class="base">
      <h1>Dét Sgu Da Dine Egne BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor du kan slette dine lidt for blærede billeder</h2>
      <form action="userImages.php" method="post" class="nav-button">
        <input type="submit" name="logout" value="Log ud">
      </form>
      <form action="userImages.php" method="post" class="nav-button">
        <input type="submit" name="goto-images" value="Alle Blærede Billeder">
      </form>
      <form action="userImages.php" method="post" class="nav-button">
        <input type="submit" name="goto-users" value="Alle Brugere">
      </form>
      <?php
        if(isset($removeImageResponse)) {
        echo "<p class='error-response'> $removeImageResponse</p>";
        }
      ?>
      <div class="table-container">
      <div class="row"> 
            <div class="column" id="column1">
                <?php
                    echo $column1;
                ?>
            </div>
            <div class="column" id="column2">
                <?php
                    echo $column2;
                ?>
            </div> 
            <div class="column" id="column3">
                <?php
                    echo $column3;
                ?>
            </div>
            <div class="column" id="column4">
                <?php
                    echo $column4;
                ?>
            </div>
        </div>
      </div>
      <footer class="footer" id="footer">
      <p>Copyright: none</p>
      <p>Terms of use: none</p>
    </footer>
    </div>
  </body>
</html>
