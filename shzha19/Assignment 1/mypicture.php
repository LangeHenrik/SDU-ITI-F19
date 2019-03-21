<!doctype html>
<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
    <title>My pictures</title>
    <link rel="stylesheet" href="pictures.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
    
</style>

</head>

<body style="text-align: center;">
	<?php 
	$conn = mysqli_connect("localhost","root","","shzha19") or die('Unable to connect');
	mysqli_query($conn,"set names utf8");
	$username = $_SESSION["username"];
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
            <a href="pictures.php">Pictures</a>
        </li>
        <li class="">
            <a href="user.php">Users</a>
		</li>
		<li>
			<a href="#">My Pictures</a>
		</li>
    </ul>
	</div>
	
	<div  style="background: gray;  margin:auto">
		<!-- 提交界面 -->
		<div style=" margin: auto;top:0; right: 0; left: 0; bottom: 0; width: 300px; height: 230px">
			<form method="post" enctype='multipart/form-data'>
				<table>
					<tr><td style="height: 40px;"><span style="font-size:large; ">Header:</span></td>
						<td><input type="text" name="header" style=" border-radius:5px"></td>
					</tr>
					<br/>
					<tr><td><span style="font-size:large; ">Content:</span></td>
						<td><textarea name="content" rows="3" cols="23" style="border-radius:5px;"></textarea></td>
					</tr>
				
				</table>
				<br/>
				<input type="file" name="picture" id="picture" value="upload">
			
			<br/>
			<input type="submit" name="submit" value="Submit">
			</form>
			
			
		</div>
		<HR width="100%" color=#FFFFFF SIZE=1>
		<!-- 显示个人图片 -->
		<div style=" margin: auto;top:0; right: 0; left: 0; bottom: 0; width: 800px;">
			<?php
			$cmdStr = "select msgview.MsgID,msgview.username,usersinfo.photo,msgview.MsgHeader,msgview.MsgContent,msgview.picture FROM usersinfo,msgview WHERE usersinfo.username ='$username' and msgview.username='$username'"; 
			$result = mysqli_query($conn,$cmdStr);
			while($row = mysqli_fetch_array($result)){?>
			<div style="border-radius: 10px;  height: 40%; width: 100%;  ">
		   		<div class="col-md-2" style="margin: 1%; border-radius: 10px;  height: 80%; width: 26%">
					<?php
						echo "<img src='{$row['photo']}' class='round_icon' >";
					?>
					
					<h3><?php echo "{$row['username']}"?></h3>
           		</div>	
				<div class="col-md-2" style="margin: 1%; border-radius: 10px; width:70%; height: 80%; word-break:break-all;word-wrap:break-word">
				
					<?php
						echo "<img src='{$row['picture']}' class='square_icon'  >";
					?>
					

					<h3><?php echo "{$row['MsgHeader']}"?></h3>
					<h4><?php echo "{$row['MsgContent']}"?></h4>
            	</div>
				<!------>
				<div style="width: 100%; text-align: center">
					
					<a href="mypicture.php?id=<?php echo $row["MsgID"]; ?>"><input name="delete" value="Delete" type="submit" /></a>
					
					
				</div>
			</div>
			<br/><HR width="100%" color=#FFFFFF SIZE=1>
			<?php
			}
			?>
			
		</div>	
		
				
			
			
	
	</div>
	
	
	
	
	
	
	
	<?php	
	
	//上传
	if(isset($_POST['submit'])){
		$header = $_POST['header'];
		$content = $_POST['content'];
		//echo $content;
		if(!empty($_FILES['picture']['name'])){
			$a = substr(strrchr($_FILES["picture"]["type"],'/'),1);//获取图片后缀
			$filepath="./pictures/".time().".".$a;
			$bool = move_uploaded_file($_FILES['picture']['tmp_name'],$filepath);//上传图片到文件夹
			/*
			if($bool)
				echo "上传到文件夹成功";
			else
				echo "上传到文件夹失败";
			*/
			$dbpath= "/ass/pictures/".time().".".$a;   //存入数据库的路径
			//存入数据库
			$sqlInsert = "insert into msgview(username,MsgHeader,MsgContent,picture) values('$username','$header','$content','$dbpath')";
			if(mysqli_query($conn, $sqlInsert)){
				echo "<script>alert('Submitted successfully');window.location.href='pictures.php';</script>";
			}
			else
				echo "<script>alert('Something went wrong. Please try again')</script>";
		}
		else{
			echo "<script>alert('Please upload a picture')</script>";
			exit;
		}
	}
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		
		$sqlDelete = "delete from msgview where msgview.MsgID = '{$id}'";
		if(mysqli_query($conn, $sqlDelete)){
			echo "<script>alert('Deleted successfully');window.location.href='pictures.php';</script>";
		}
		else{
			echo "<script>alert('Something went wrong. Please try again')</script>";
		}
	
	}
	
	
	
	
	
	
	?>
</body>
</html>