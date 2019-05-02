<header id="title_bar" class="title_bar"> 
	<a href="/heboe17/mvc/public/" id='index_link'> HCHB's Exercise </a> 
	&nbsp;
	<?php 	
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		?>
		<a href="/heboe17/mvc/public/Posts"> Posts </a> 
		&nbsp;
		<a href="/heboe17/mvc/public/Upload"> Upload </a> 
		&nbsp;
		<a href="/heboe17/mvc/public/Users"> Users </a> 
		&nbsp;
		<a href="/heboe17/mvc/public/Home/logout" method="post" class="login_logout" > Logout </a>	
		<?php
	} else {
		echo '<a href="/heboe17/mvc/public/Login" class="login_logout"> Login </a>';
	}
	?>
</header>