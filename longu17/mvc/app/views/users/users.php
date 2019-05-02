<? include '../app/views/partials/menu.php'; ?>
<style><?include("css/bootstrap.css");?></style>
<style><?include("css/users.css");?></style>
<?ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>


    <!-- Ajax, get users from search bar without refresh -->
<script>
  function showUser(str) {
      if (str == "") {
          document.getElementById("user-search").innerHTML = "";
          return;
      } else { 
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("user-search").innerHTML = this.responseText;
              }
              console.log(str);
          };
          //xmlhttp.open("GET","../mvc/app/views/users/ajax.php?q="+str,true);
          xmlhttp.open("GET","Users/search/"+str,true);
          xmlhttp.send();
    }
}
</script>

</head>
<input name="users" type="text" placeholder="AJAX" style="text-align:center;" onkeyup="showUser(this.value)">
<br>
<div id="user-search"></div>
<?php 

// nedennder er ikke ajax det er bare vis brugere
echo '<body>'; 


       
foreach( $viewbag as $user ) {
$first = $user['First_Name'];
$last = $user['Last_Name'];
$username = $user['Username'];
echo "
<div class='card'>

<header>";

if($user['Profile_Image'] == NULL)
{
  echo "<img src='../app/views/users/default.jpg' class='profile'/>";
} else 
{
  $photo = $user['Profile_Image'];
  $class = 'class="profile"';
  echo '<img src='."data:image/jpeg;base64,$photo" . ' class="profile"> ';
  //echo "<img src='".$user['Profile_Image']."' class='profile'/>";
}
echo "
  </header>
  
  <article>
  <h1><h3> $first $last  </h3></h1>
  <h4><small> $username </small></h4>
  <br>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur dicta, perferendis quasi dolorum a repellat tempore doloremque, magni quia quam nesciunt, 
    ducimus ut reiciendis soluta. Accusantium, saepe! Sequi, eaque perferendis!.</p>
  </article>

  <footer>
    <ul class='list-unstyled'>
     <li><a href='https://facebook.com'><i class='fa fa-fw fa-codepen'></i> Facebook</a></li>
      <li><a href='https://twitter.com/'><i class='fa fa-fw fa-twitter'></i> Twitter</a></li>
      <li><a href='https://github.com/'><i class='fa fa-fw fa-github'></i> Github</a></li>
    </ul> 
    <hr>
    <p class='cf'>
      <small>
      <a class='align-left add' href='users'><i class='fa fa-fw fa-add'></i> Add Friend</a>
      </small>
    </p>
  </footer>
</div> <!--end card-->
";
}
?>
</body>

</html>