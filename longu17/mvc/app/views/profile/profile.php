<? include '../app/views/partials/menu.php'; ?>
<style><?include("css/bootstrap.css");?></style>
<style><?include("css/profile.css");?></style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
</head>
<body>
  <div class="card">
  <header>
<div>

<?php    
  if($viewbag['Profile_Image'] == null) {
        echo "<img src='default.jpg' class='profile'/>";
    } else {
      $profileImage = $viewbag['Profile_Image'];
        echo '<img src='."data:image/jpeg;base64,$profileImage" . ' class="profile"> ';
    }
?>
  </header>
  <article class="userinfo">
  <h2 style="text-align:center;"><?echo($viewbag['First_Name'])?> <?echo($viewbag['Last_Name'])?> </h2>
  <br>
  <hr>
  <small>
    <p><b>userid</b>: <?echo($viewbag['UserID'])?> </p>
    <p><b>zip</b>: <?echo($viewbag['Zip'])?> </p>
    <p><b>city</b>: <?echo($viewbag['City'])?> </p>
    <p><b>email</b>: <?echo($viewbag['Email'])?> </p>
    <p><b>phone</b>: <?echo($viewbag['Phone_Number'])?> </p>

</small>
  </article>
  <footer>
    <hr>
    <p class="cf">
      <small>
      <a class="align-left logout" href="logout"><i class="fa fa-fw fa-logout"></i> Logout</a>
      </small>
    </p>
  </footer>
</div> <!--end card-->
<footer class="closure">
</body>
</html>
