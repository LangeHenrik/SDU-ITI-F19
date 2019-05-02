<?php include '../app/views/partials/menu.php'; ?>
<!DOCTYPE html>
<body>
<?php
if(isset($_SESSION['imagestatus'])){
	echo $_SESSION['imagestatus'];
}
?>
<form action="/jobjo17/mvc/public/image/uploadpicture" enctype="multipart/form-data" method="post">
    <input type="text" name="title" placeholder="Enter a title." required>
	<input type="text" name="description" placeholder="Enter a description" required>
    <input type="file" name="image" accept="image/gif, image/jpeg, image/png" name="image" placeholder="Choose an image" required>
    <input type="submit" value="Submit">
</form>
</body>
</html>
<?php
if(isset($_SESSION['imagestatus'])){
	unset($_SESSION['imagestatus']);
}
?>