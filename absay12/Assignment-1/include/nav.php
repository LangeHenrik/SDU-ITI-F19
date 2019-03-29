<?php   
    if(isset($_SESSION['Login'])) {
        echo '<div class="topnav">
			  <a href="index.php">Home</a>
			  <a href="upload.php">Upload</a>
			  <a href="users.php">Users</a>
			  <a href="ajax.php">Ajax</a>
			  <a href="logout.php">Logout</a>
			</div>';
    } else {
        echo '<div class="topnav">
			  <a href="index.php">Home</a>
			  <a href="upload.php">Upload</a>
			  <a href="users.php">Users</a>
			  <a href="ajax.php">Ajax</a>
			  <a href="login.php">Login</a>
			</div>';
    } 
?>  
