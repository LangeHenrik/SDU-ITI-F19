<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <meta charset="utf-8">
    <title>Pictures</title>
    <link rel="stylesheet" href="pictures.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center;">
	
	<?php
	include 'Page.php';
	$conn = mysqli_connect('localhost','root','','shzha19') or die('连接失败');
	mysqli_query($conn,"set names utf8");//保证中文不乱码
	
	$sql = "select count(*) as totalRows from msgview";
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)) {
		$totalRows = $row['totalRows'];
	}
	$pageSize = 2;
	$page = new Page($totalRows,$pageSize);
	
	//$cmdStr = "select msgview.username,usersinfo.photo,msgview.MsgHeader,msgview.MsgContent,msgview.picture FROM usersinfo,msgview WHERE usersinfo.username = msgview.username"; 
	//$result = mysqli_query($conn,$cmdStr);
	?>

<div style=" height: 10%;">
    <div style="vertical-align: middle;">
       <h2>Hello <?php echo $_SESSION["username"];    ?></h2>
		<a href="Login.php" style="font-size: large; position: absolute;top:30px;right: 30px;">Log out</a>
    </div>
</div>

<div class="navbar-collapse collapse"
     style="text-align: center; vertical-align: center; background: lightgrey; font-size: 20px;">
    <ul class="nav navbar-nav" style="display: inline-block;float: none;">
        <li class="active">
            <a href="#">Pictures</a>
        </li>
        <li class="">
            <a href="user.php">Users</a>
		</li>
		<li>
			<a href="mypicture.php">My Pictures</a>
		</li>
    </ul>
	
</div>

<div class="row" style="margin-top: 1%; height:100%; width: 100%">
    <div class="col-md-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
    <div class="col-md-8" style="background: gray;   height: 100%;">
		
		<?php
		$sql = "select * from msgview,usersinfo where usersinfo.username = msgview.username ".$page->limit;
		
		
		$res = mysqli_query($conn,$sql);
		
		while($row = mysqli_fetch_assoc($res)){?>
		<div style="border-radius: 10px;  height: 40%; width: 100%;  ">
		    <div class="col-md-2" style="margin: 1%; border-radius: 10px;  height: 80%; width: 26%">
				<?php
				echo "<img src='{$row['photo']}'";
				?>
                <img class="round_icon"  alt="">
                <h3><?php echo "{$row['username']}"?></h3>
            </div>	
			<div class="col-md-2" style="margin: 1%; border-radius: 10px; width:70%; height: 80%; word-break:break-all;word-wrap:break-word">
				
                <?php
				echo "<img src='{$row['picture']}' class='square_icon'  >";
				?>	
				
             
				<h3><?php echo "{$row['MsgHeader']}"?></h3>
                <h4><?php echo "{$row['MsgContent']}"?></h4>
            </div>
		</div>
		<br/><HR width="100%" color=#FFFFFF SIZE=1>
		<?php
		}
		?>
        

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