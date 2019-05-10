<!-- ?php include '../app/views/partials/menu.php';  for header!-->

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="api/css/login.css">
	<link rel="stylesheet" href="../api/css/login.css">
</head>

<body>
<div class="login">

<form class="loginForm" method="post">
	<h1>Login</h1>
	<input name="username" type="text" class="inputcss" placeholder="Enter username"/><br>
	<input name="password" type="password" class="inputcss" placeholder="Enter password"/><br>


	<button type="submit" href ="./users.php/" id="login_btn" class="button" value="Login"> Login </button> </br>

	<p> <a href="Register"> Register </a> as user </p>

</form>
</div>

</body>
</html>
