<?php include '../app/views/partials/start.php'; ?>
<?php 
    $pointer =1;
    $column1 ='';
    $column2 ='';
    $column3 ='';
    $column4 ='';

    
    foreach($viewbag["initialImages"] as $row){
        $tmp='<div class="img"><h3>'.$row['title'].'</h3>'.'<img src="data:image/;base64,'.$row['media_name'].'"><p>'.$row['description'].'</p></div>';
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

<h1>Dét Sgu Da ALLES BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor du kan se alles blærede billeder</h2>
      <?php include '../app/views/partials/logoutButton.php'; ?>
      
      <?php include '../app/views/partials/usersButton.php'; ?>
      <?php include '../app/views/partials/userImagesButton.php'; ?>
      
      <div class="form-container upload">
        <form class="form-classic" method="post" enctype="multipart/form-data" action="/magle17/mvc/public/Images/uploadImage/">
            <fieldset class="fieldset-classic">
                <legend>Upload et Blæret Billede!</legend>
                <p>Titel</p>
                <input type="text" name="title"><br><br>
                <p>Description</p>
                <textarea name="description" rows="5" cols="40"></textarea><br><br>
                <input type="file" name="image-upload"><br><br>
                <button type="btn-upload">Upload</button>
                <?php
                if(isset($viewbag["respons"])) {
                    echo "<p class='error-response'>".$viewbag["respons"]." </p>";
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

<?php include '../app/views/partials/end.php'; ?>