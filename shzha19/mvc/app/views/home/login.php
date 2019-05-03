<html>
<head>
	<meta charset="utf-8">
	<title>Log in</title>
	<link href="/shzha19/mvc/public/css/login_register.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body style="background-color: lightgray">
	<script type="text/javascript">
		function checkLogin(){
			if(myform.username.value==""){
				alert("Please enter your username!");
				myform.username.focus();
				return false;
			}
			else if(myform.password.value==""){
				alert("Please enter your password!");
				myform.password.focus();
				return false;
			}
		}
	</script>
	<div class="message warning">
		<div class="inset">
			<div class="login-head">
				<h1>Log in</h1>
							
			</div>
			
			<form action="/shzha19/mvc/public/index.php/login" method="post" name="myform"> 
	
				<li><input type="text" name="username" id="username" placeholder="Username" /></li>
				<li><input type="password" name="password" id="password" placeholder="Password"/></li>
				
				<div class="submit">
					<input id="submit" type="submit" value="Submit" onClick="return checkLogin()"/>
					<h3><a href="/shzha19/mvc/public/index.php/register">Create Account</a></h3>
					<div class="clear"> </div>
				</div>
				
			</form>
		</div>
	</div>
	<div class="clear"> </div>
	


</body>
</html>
