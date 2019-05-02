<style><?include("css/bootstrap.css");?></style>
<style><?include("css/profile.css");?></style>
<?php
if(!isset($_SESSION['user_id']))
{    
        exit("not logged in");
}
session_start();
include_once("./common/nav.php");
include_once("./controllers/profile.php");
?>

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
  if($info['Profile_Image'] == null)
{
    echo "<img src='../images/default.png' class='profile'/>";
} else 
{
    echo "<img src='".$info['Profile_Image']."' class='profile'/>";
}
?>
  </header>
  <article class="userinfo">
  <h2 style="text-align:center;"><?echo($info['First_Name'])?> <?echo($info['Last_Name'])?> </h2>
  <br>
  <hr>
  <small>
    <p><b>userid</b>: <?echo($info['UserID'])?> </p>
    <p><b>zip</b>: <?echo($info['Zip'])?> </p>
    <p><b>city</b>: <?echo($info['City'])?> </p>
    <p><b>email</b>: <?echo($info['Email'])?> </p>
    <p><b>phone</b>: <?echo($info['Phone_Number'])?> </p>

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
