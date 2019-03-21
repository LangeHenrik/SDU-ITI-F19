<?php
	$username=$_GET['username'];
	
	
	if(!preg_match('/^[\w\x80-\xff]{1,20}$/', $username)){
			echo "Username is illegal！";
			exit;
	}
	else{
		$link=mysqli_connect("localhost","root","","shzha19");
		$sql=mysqli_query($link,"select * from usersinfo where username='".$username."'");
		$info=mysqli_fetch_array($sql);
		if ($info){
			echo "Someone already has that username. Try another?";
		}else{
			echo "You can use this username!";
		}
	}

	
	
?>
