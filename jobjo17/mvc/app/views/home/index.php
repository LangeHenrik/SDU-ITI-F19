<?php include '../app/views/partials/menu.php'; ?>
<!DOCTYPE html>
<style>
.yeet {
	width: 50%;
	min-width: 100px;
	max-width: 200px;
}
</style>
<body>

<form action="/jobjo17/mvc/public/home/login" onsubmit="" name="loginform" class="yeet" method="post">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit" value="Submit">
</form>

<?php 
if(isset($_SESSION["error"])) {
	echo "<span>".$_SESSION["error"]."</span>";
}
?>
<form action="/jobjo17/mvc/public/home/register">
	<input type="submit" value="Register users">	
</form>

</body>
</html>
<?php
	unset($_SESSION["error"]);
	?>