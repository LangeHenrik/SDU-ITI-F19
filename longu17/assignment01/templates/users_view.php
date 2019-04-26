<style><?include("css/bootstrap.css");?></style>
<style><?include("css/users.css");?></style>
<?php
if(!isset($_SESSION['user_id']))
{    
        exit("not logged in");
}
session_start();
include_once("./common/nav.php");
include_once("./controllers/users.php");
?>

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
        };
        xmlhttp.open("GET","./controllers/ajax.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

</head>
<input name="users" type="text" placeholder="AJAX" style="text-align:center;" onkeyup="showUser(this.value)">
<br>
<div id="user-search"></div>
<body>

<?php    
foreach( $users as $user ) {
$first = $user['First_Name'];
$last = $user['Last_Name'];
echo "
<div class='card'>

<header>";

if($user['Profile_Image'] == NULL)
{
  echo "<img src='../images/default.png' class='profile'/>";
} else 
{
  echo "<img src='".$user['Profile_Image']."' class='profile'/>";
}
echo "
  </header>
  
  <article>
  <h1><h3> $first $last  </h3></h1>
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
