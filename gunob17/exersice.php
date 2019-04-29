<html>
<form class=""  method="post">
  <input type="text" name="username" value="" placeholder="username">
  <input type="password" name="password" placeholder="password">
  <input type="submit" name="submit" id="submit">
<br/>


</form>
</html>
<?php
if(ifset($_POST['username']) && !empty($_POST['usename'])){
echo $_POST['username'];}
?>
