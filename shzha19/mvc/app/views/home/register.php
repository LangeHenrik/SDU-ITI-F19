<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link href="/shzha19/mvc/public/css/login_register.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body style="background-color: lightgray">
	<!--AJAX-->
	<script language="javascript">
	function checkName() {
		var username = myform.username.value;
		if(username=="") {
			window.alert("please enter a username!");	
			form1.username.focus();
			return false;
		}
		else {
			createRequest('/shzha19/mvc/public/home/ajax/'+username);
	
			}
	}
	
	var http_request = false;
	function createRequest(url) {
		//url = url + "&nocache='+new Date().getTime()";
		
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
			<li>A username can contain alphanumeric characters (letters A-Z, numbers 0-9) and underscores</li><br/>
			<b>Password</b><br/>
			<li>Must be at least 6 characters.</li>	
	</div>
	
	<div class="message warning">
		<div class="inset">
			<div class="login-head">
				<h1>Sign Up</h1>		
			</div>
			
			<form action="/shzha19/mvc/public/index.php/register" method="post" name="myform" enctype='multipart/form-data'>
				<li><input id="Text1" type="text" name="username" placeholder="Username *" /></li>
				<a href="#" onClick="checkName();">[check]</a>
				<li><input id="Password2" type="password" name="password" placeholder="Password *" /></li>
				<li><input type="password" name="confirmPwd" placeholder="Confirm Password *"/></li>
				<li><input type="text" name="firstname" placeholder="First Name *"/></li>
				<li><input type="text" name="lastname" placeholder="Last Name *"/></li>
				<li><input type="text" name="zip" placeholder="Zip *"/></li>
				<li><input type="text" name="city" placeholder="City *"/></li>
				<li><input type="text" name="email" placeholder="Email *"/></li>
				<li><input type="text" name="phone" placeholder="Phone *"/></li> 
				<li><label for="files">Upload Photo</label><input type="file" name="photo" id="photo" placeholder="upload "/></li>
				<input id="submit" name="submit" type="submit" value="Submit" onClick="return checkRegister()"/>
				<h3>Already have an account?<a href="/shzha19/mvc/public/index.php/login">Log in</a></h3> 
			</form>

			
			
			
			
		</div>
	</div>
	<div class="clear"> </div>
	

</body>
</html>