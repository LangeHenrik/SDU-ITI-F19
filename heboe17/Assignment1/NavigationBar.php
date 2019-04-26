<header id="title_bar" class="title_bar"> 
	<a href="Index.php" id='index_link'> HCHB's Exercise </a> 
	&nbsp;

	<?php 
	// ****
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		?>
		<a href="Posts.php"> Posts </a> 
		&nbsp;
		<a href="UploadPost.php"> Upload </a> 
		&nbsp;
		<a href="Users.php"> Users </a> 
		&nbsp;
		<a href="Logout.php" class="login_logout" > Logout </a>	
		<?php
	} else {
		echo '<a href="Login.php" class="login_logout"> Login </a>';
	}
	?>

</header>