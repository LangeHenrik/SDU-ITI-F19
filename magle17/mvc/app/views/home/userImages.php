<?php include '../app/views/partials/start.php'; ?>
<?php
  $pointer =1;
  $column1 ='';
  $column2 ='';
  $column3 ='';
  $column4 ='';

  foreach($viewbag["initialUserImages"] as $row){
      $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="data:image/;base64,'.$row['media_name'].'"><p>'.$row['description'].'</p><form action="/magle17/mvc/public/UserImages/removeImage/" method="post"><input type="hidden" name="image-id" value="'.$row['id'].'"><input type="submit" name="remove-image" value="Slet"></form></div>';
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
?>
<body onscroll="monitorScroll()">
<div class="base">
<h1>Dét Sgu Da Dine Egne BLÆREDE BILLEDER</h1>
<h2>Stedet hvor du kan slette dine lidt for blærede billeder</h2>
<?php include '../app/views/partials/logoutButton.php'; ?>
<?php include '../app/views/partials/imagesButton.php';?>
<?php include '../app/views/partials/usersButton.php'; ?>
<?php
    if(isset($viewbag["removeImageResponse"])) {
        echo "<p class='error-response'>".$viewbag["removeImageResponse"]."</p>";
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



<?php include '../app/views/partials/end.php'; ?>