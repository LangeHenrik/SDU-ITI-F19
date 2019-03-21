<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <meta charset="utf-8">
    <title>User</title>
    <link rel="stylesheet" href="users.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center">
	
	
	
	<?php
	include 'Page.php';
	
	
	
	$conn = mysqli_connect('localhost','root','','shzha19') or die('连接失败');
	mysqli_query($conn,"set names utf8");//保证中文不乱码
	$sql = "select count(*) as totalRows from usersinfo";
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)) {
		$totalRows = $row['totalRows'];
	}
	
	$pageSize = 12;
	$page = new Page($totalRows,$pageSize);
	
	//$cmdStr = "select username,photo from usersinfo";
	//$result = mysqli_query($conn, $cmdStr);
	
	
	?>
<div style="height: 10%">

	<h2>Hello <?php echo $_SESSION["username"]; ?></h2>
	<a href="Login.php" style="font-size: large; position: absolute;top:30px;right: 30px;">Log out</a>
	
	
</div>
<div class="navbar-collapse collapse"
     style="text-align: center; vertical-align: center; background: lightgrey; font-size: 20px;">
    <ul class="nav navbar-nav" style="display: inline-block;float: none;">
        <li class="active">
            <a href="pictures.php">Pictures</a>
        </li>
        <li class="">
            <a href="#">Users</a>
        </li>
		<li>
			<a href="mypicture.php">My Pictures</a>
		</li>
    </ul>
</div>

<div class="row" style="margin-top: 1%; height: 100%; width: 100%">
    <div class="col-md-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
    <div class="col-md-8" style="background: gray; height: 100%;">
		
        <!--div style="margin: 1%; border-radius: 10px; background-color: lightgrey; height: 28%; width: 20%; float:left">-->
			<?php
			$sql = "select * from usersinfo ".$page->limit;
			
			$res = mysqli_query($conn,$sql);
			$count = 0;
			while($row = mysqli_fetch_assoc($res)){?>
				<div style="margin: 1%; border-radius: 10px; background-color: lightgrey; height: 28%; width: 20%; float:left">
				<?php
				echo "<img src='{$row['photo']}'";?>
				<img  class="round_icon"  alt="">
            <h3><?php echo "{$row['username']}"?></h3>
			</div>
			
			<?php
					//每行显示四个头像
				$count++;
				if($count%4==0)
					echo "<br/>";
			}
			
			
			?>	
        <!--</div>-->
		
        
		
    </div>
    <div class="col-md-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
	
	<h3><?php $page->show(); ?></h3>
	
	
</div>
<br/><br/>
<div>
    <p style="color: lightgray">Copyright @2019 S.Y.Zhang <a style="color: lightgray" href="https://www.sdu.dk/"><u>SDU</u></a> </p>
</div>

	

</body>
</html>