<!DOCTYPE html>

<?php

  session_start();
  if (!isset($_SESSION["username"])) {
    header("location:login.php");
  }

  global $pdo;

  $msg = "";
  // If upload button is pressed
  if (isset($_POST['upload'])) {
    // The path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    // Connect to the database
    require_once("db_config.php");
    $object = new db_config_class;
    $db = $object->connect();

    // Get all the sumbmitted data from the form
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];
    $header = $_POST['header'];

    // prepare
    $sql = $db->prepare("INSERT INTO photo (photo_image, photo_text, photo_header) VALUES ('$image', '$text', '$header')");
    $sql->execute(); // Stores the submitted data into the database table: photo

    // Move the uploaded image into the folder: images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded succesfully";
    } else {
      $msg = "There was a problem uploading image";
    }
  }

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



    <title>Pictures</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="logo">
          <img src="img/logo.png" height="50" alt="" title="">
        </div>

        <nav>
          <li><a href="pictures.php">Pictures</a></li>
          <li><a href="users.php">Users</a></li>
          <?php
            if (isset($_SESSION["username"])) {
              echo '<li><a href="logout.php">Logout</a>';
            }
          ?>
        </nav>
        </div>
      </div>
    </header>

    <div class="content" id="content">
      <?php
        echo '<h1>You are now logged in '.trim($_SESSION["name"]).'. Good for you!</h1><br>';
      ?>

      <form class="upload" action="pictures.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
          <input type="file" name="image">
          <br><br>
        </div>
        <div>
          <label class="header" for="header">Header &nbsp; </label>
          <input type="text" size="40" name="header" placeholder="Header here..">
          <br><br>
        </div>
        <div>
          <textarea name="text" rows="4" cols="40" placeholder="Say something about this image..."></textarea>
        </div>
        <div>
          <input type="submit" name="upload" value="Upload Image">
        </div>
      </form>

        <?php
          // Connect to the database
          require_once("db_config.php");
          $object = new db_config_class;
          $db = $object->connect();


          $stmt = $db->prepare("SELECT * FROM photo LIMIT 20;");
          //$stmt->bindParam(":id", $id);
          $stmt->execute();


          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div id="img_div">
              <tr id="<?php echo $row['photo_id']; ?>">
                <td data-target="photo_header"><h3><?php echo $row['photo_header']?></h3></td>
                <td>  <img src="images/<?php echo $row['photo_image'] ?>"></td>
                <td data-taget="photo_text"><p> <?php echo $row['photo_text']; ?></p></td>
                <td><a href="#" data-role="update" data-id="<?php echo $row['photo_id']; ?>">Update</a></td>
              </tr>
            </div>
          <?php }
        ?>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change image description</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Header</label>
              <input type="text" id="photo_header" class="form-control">
            </div>
            <div class="form-group">
              <label>Image description</label>
              <input type="text" id="photo_text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>


  </body>

<script>
  $(document).ready(function() {
    $(document).on('click','a[data-role=update]',function(){
      var id  = $(this).data('id');
      var header  = $('#'+id).children('td[data-target=photo_header]').text();
      var description  = $('#'+id).children('td[data-target=photo_text]').text();

      $('#photo_header').val(header);
      $('#photo_text').val(description);

      $('#photo_id').val(id);
      $('#myModal').modal('toggle');
    });

    $('#save').click(function(){
          var id  = $('#photo_id').val();
          var header =  $('#photo_header').val();
          var description =  $('#photo_text').val();

          $.ajax({
              url      : 'connection.php',
              method   : 'post',
              data     : {header : header , description: description , id: id},
              success  : function(response){
                            // now update user record in table
                             $('#'+id).children('td[data-target=photo_header]').text(photo_header);
                             $('#'+id).children('td[data-target=photo_text]').text(photo_text);
                             $('#myModal').modal('toggle');

                         }
          });
       });
  });
</script>

</html>
