	<a href="/Asdoe17/mvc/public/" id='index_link'> </a>
	<?php
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		?>

			
				<li><a href="/Asdoe17/mvc/public/Posts"> Pictures </a></li>
				<li><a href="/Asdoe17/mvc/public/Upload"> Upload </a></li>
				<li><a href="/Asdoe17/mvc/public/Users"> Users </a></li>
				<li><a href="/Asdoe17/mvc/public/Home/logout" method="post"> Logout </a></li>


		<?php
	} else {
		echo '<a href="/Asdoe17/mvc/public/Login" class="login_logout"> Login </a>';
	}
	?>
