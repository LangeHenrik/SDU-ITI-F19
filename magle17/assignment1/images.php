
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
if(isset($_POST["goto-users"])){
    heder('Location: users.php');
}


require_once 'db_config.php';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $preparedGetImages=$conn->prepare('SELECT * FROM media LIMIT :offset,4');
    $preparedGetInitialImages=$conn->prepare("SELECT * FROM media limit 20");
    $stmtUploadImage = $conn->prepare("INSERT INTO media (uploaded_by, media_name, title, description) VALUES (:userID, :imageName, :title, :description)");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

    $pointer =1;
    $column1 ='';
    $column2 ='';
    $column3 ='';
    $column4 ='';

    $preparedGetInitialImages->execute();
    $preparedGetInitialImages->setFetchMode(PDO::FETCH_ASSOC);
    $result=$preparedGetInitialImages->fetchAll();
    foreach($result as $row){
        $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="media/'.$row['media_name'].'"><p>'.$row['description'].'</p></div>';
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
        $preparedGetImages->execute();
        $preparedGetImages->setFetchMode(PDO::FETCH_ASSOC);
        $result=$preparedGetImages->fetchAll();
        $preparedGetImages=null;
        
        $columns=array();
        
        if(sizeof($result)==0){
            echo '0';
        }else{
            $_SESSION['offset']+=4;
            foreach($result as $row){
                $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="media/'.$row['media_name'].'"><p>'.$row['description'].'</p></div>';
                array_push($columns,$tmp);
            }
            echo json_encode($columns);
        }  
    }
}


if (isset($_FILES['image-upload'])) {
    $respons = "";
    $fileName = $_FILES['image-upload']['name'];
    $fileSize = $_FILES['image-upload']['size'];
    $fileTmp = $_FILES['image-upload']['tmp_name'];
    $fileType = $_FILES['image-upload']['type'];
    $fileNameExploded = explode ('.', $_FILES['image-upload']['name']);
    $fileExt = strtolower(end($fileNameExploded));
    $validExtensions = array("jpeg", "jpg", "png");
    if (in_array($fileExt, $validExtensions) === false) {
        $respons = $respons . "Ublæret filtype! Kun .jpeg, .jpg and .png filer er tilladt<br>";
    }
    if ($fileSize > 1000000) {
        $respons = $respons . "Filen er lidt for blæret til os! Vælg en mindre blæret fil.<br>";
    }
    if ($respons === "") {
        $uploadFileName = time() . "-" . $fileName;
        # Upload file
        move_uploaded_file($fileTmp, "media/" . $uploadFileName);
        $inputHeader = htmlentities(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
        $inputDescription = htmlentities(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));

        $stmtUploadImage->bindparam(':userID', $_SESSION['loggedInUser']);
        $stmtUploadImage->bindparam(':imageName', $uploadFileName);
        $stmtUploadImage->bindparam(':title', $inputHeader);
        $stmtUploadImage->bindparam(':description', $inputDescription);
        $stmtUploadImage->execute();

        $respons =  "File uploaded!";
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
      <h1>Dét Sgu Da BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor intet er privat og alt er lovligt</h2>
      <form action="images.php" method="post">
          <input type="submit" name="logout" value="Log ud">
      </form>
      <form action="images.php" method="post">
          <input type="submit" name="goto-users" value="Brugeradminstration">
      </form>
      <div class="form-container upload">
        <form class="form-classic" method="post" enctype="multipart/form-data">
            <fieldset class="fieldset-classic">
                <legend>Upload et Blæret Billede!</legend>
                <p>Titel</p>
                <input type="text" name="title"><br><br>
                <p>Description</p>
                <textarea name="description" rows="5" cols="40"></textarea><br><br>
                <input type="file" name="image-upload"><br><br>
                <button type="btn-upload">Upload</button>
                <?php
                if(isset($respons)) {
                echo "<p class='error-response'> $respons</p>";
                }
                ?>
            </fieldset>
        </form>
      </div>
      <div class="inbetweener">
          <p >
              <b>Eller Kig På De Blærede Billeder!</b>
          </p>
      </div>
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
