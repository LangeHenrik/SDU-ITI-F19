<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	   
	
	
</head>

<body style="background-color: lightgray">
	<!-- AJAX -->
<script language="javascript">
var http_request = false;
function createRequest(url) {
	//初始化对象并发出XMLHttpRequest请求
	http_request = false;
	if (window.XMLHttpRequest) { 										//Mozilla等其他浏览器
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType("text/xml");
		}
	} else if (window.ActiveXObject) { 								//IE浏览器
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
		   } catch (e) {}
		}
	}
	if (!http_request) {
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	http_request.onreadystatechange = alertContents;   					 //指定响应方法
	
	http_request.open("GET", url, true);								 //发出HTTP请求
	http_request.send(null);
}
function alertContents() {   											 //处理服务器返回的信息
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			alert(http_request.responseText);
		} else {
			alert('您请求的页面发现错误');
		}
	}
}
</script>
<script language="javascript">
function checkName() {
	var username = myform.username.value;
	if(username=="") {
		window.alert("please enter a username!");
		form1.username.focus();
		return false;
	}
	else {
		createRequest('checkname.php?username='+username+'&nocache='+new Date().getTime());
	}
}
</script>
	
	
	
	
	
	<script type="text/javascript"> //js判断输入不能为空
	function checkRegister(){
		
		if(myform.password.value==""){
			alert('please enter a password!');
			myform.password.focus();
			return false;
		}
		if(myform.confirmPwd.value != myform.password.value){
			alert('The password and confirmation password do not match!');
			myform.confirmPwd.focus();
			return false;
		}
		if(myform.firstname.value==""){
			alert('Please enter your first name!');
			myform.firstname.focus();
			return false;
		}
		if(myform.lastname.value==""){
			alert('Please enter your last name!');
			myform.lastname.focus();
			return false;
		}
		if(myform.zip.value==""){
			alert('Please enter your Zip code!');
			myform.zip.focus();
			return false;
		}
		if(myform.city.value==""){
			alert('Please enter your city!');
			myform.city.focus();
			return false;
		}
		if(myform.email.value==""){
			alert('Please enter your Email!');
			myform.email.focus();
			return false;
		}
		if(myform.phone.value==""){
			alert('Please enter your phone number!');
			myform.phone.focus();
			return false;
		}
	}
	
	</script>
	<div class="guide">
		
		<h3><b>Username and Password Guidelines</b></h3><br/>
			<b>Username</b><br/>
			<li>Must be between 1 and 20 characters long.</li>
			<li>A username can contain alphanumeric characters (letters A-Z, numbers 0-9) and underscores</li>
			<br/>
			<b>Password</b><br/>
			<li>Must be at least 6 characters.</li>
		
	</div>
	<div class="message warning">
		
	<div class="inset">
	<div class="login-head">
		<h1>Sign Up</h1>
		 <div class="alert-close"> </div> 			
	</div>
	
	

	<form method="post" name="myform" enctype='multipart/form-data'>
		<li>
       <input id="Text1" type="text" name="username" placeholder="Username *" /></li>
		<a href="#" onClick="checkName();">[check]</a>
    	<li>
       <input id="Password2" type="password" name="password" placeholder="Password *" /></li>
    	<li> <input type="password" name="confirmPwd" placeholder="Confirm Password *"/></li>
		<li><input type="text" name="firstname" placeholder="First Name *"/></li>
		<li><input type="text" name="lastname" placeholder="Last Name *"/></li>
		<li><input type="text" name="zip" placeholder="Zip *"/></li>
		<li><input type="text" name="city" placeholder="City *"/></li>
		<li><input type="text" name="email" placeholder="Email *"/></li>
		<li><input type="text" name="phone" placeholder="Phone *"/></li> 
		<li><label for="files">Upload Photo</label><input type="file" name="photo" id="photo" placeholder="upload "/></li>
       <div class="submit">
        &nbsp;<input id="Submit2" name="submit" type="submit" value="Submit" onClick="return checkRegister()"/>
              <h3>Already have an account?<a href="Login.php">Log in</a></h3> 
          <div class="clear"> </div>
        </div>
		</form>
		</div>
	</div>
		<div class="clear"> </div>
	
		<br/>
		
		
	
	
	<?php
	$conn = mysqli_connect("localhost","root","","shzha19") or die ('Unable to connect');
	mysqli_query($conn,"set names utf8");
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		//正则表达式检查用户名、密码和email的格式
		if(!preg_match('/^[\w\x80-\xff]{1,20}$/', $username)){
			echo "<script>alert('Username is illegal');history.back(-1);</script>";
			exit;
		}
		if(strlen($password) < 6){
			echo "<script>alert('Password must be at least 6 characters');history.back(-1);</script>";
			exit;
		}
		if(!preg_match('/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email)){
			echo "<script>alert('Wrong Email address');history.back(-1);</script>";
			exit;
		}
		
		//检查用户名是否已存在(ajax仅检测用户名是否存在，该段代码保证重名的不能注册成功)
		$sqlSelectName = "select username from usersinfo where username = '{$username}' limit 1";
		$result = mysqli_query($conn, $sqlSelectName);
		$num = mysqli_num_rows($result);
		if($num){
			echo "<script>alert('Someone already has that username. Try another?');history.back(-1);</script>";
			exit;
			
		}
		//检查email是否已被注册
		$sqlSelectEmail = "select email from usersinfo where email = '{$email}' limit 1";
		$resultEamil = mysqli_query($conn, $sqlSelectEmail);
		$numEmail = mysqli_num_rows($resultEamil);
		if($numEmail){
			echo "<script>alert('The email address you have entered is already registered!');history.back(-1);</script>";
			exit;
			
		}
		
		//取头像路径
		//if($_FILES["photo"]["size"]>0){//上传了图片
		if(!empty($_FILES['photo']['name'])){
			$a = substr(strrchr($_FILES["photo"]["type"],'/'),1);//获取图片后缀
			$filepath="./photos/".time().".".$a;
			$bool = move_uploaded_file($_FILES['photo']['tmp_name'],$filepath);//上传图片到文件夹
			/*
			if($bool){
				echo "<script>alert('上传到文件夹成功')</script>";
				
			}
			else
				echo "<script>alert('上传到文件夹失败')</script>";
			*/
			
			$dbpath= "/ass/photos/".time().".".$a;   //path:/ass/photos/a.jpg 存入数据库
			
		}
		else{
			$dbpath = "/ass/photos/default.jpg";
		}
		
		
		//写入数据库
		$password = md5($password);
		$sqlInsert = "insert into usersinfo(username,password,firstname,lastname,zip,city,email,phone,photo) values('$username', '".$password."','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["zip"]."','".$_POST["city"]."','".$email."','".$_POST["phone"]."','".$dbpath."')";
		if(mysqli_query($conn, $sqlInsert)){
			echo "<script>alert('Register success');window.location.href='Login.php';</script>";
		}
		else
			echo "<script>alert('Something went wrong. Please try again')</script>";
			
		
		
		
		
		
		
		
		
		
		

	}
		
		
	
	
	
		

	
	
	?>
	
</body>
</html>