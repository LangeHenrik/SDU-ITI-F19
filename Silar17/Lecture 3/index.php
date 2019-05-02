<html>
	<head>       
		<title>Exercice 2 lecture 1 </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="JavaScript.js"></script>
		<link rel="stylesheet" type="text/css" href="Style.css">
		
	</head>	
	<body>
		<div class="topbar">
			<inline> 
				<a class="notActive" href="pictures.php"> <u> <font color=white>Pictures</font> </u> </a> 
			</inline>
			<inline> 
				<a class="notActive" href="users.php"> <u> <font color=white>Users</font> </u> </a> 
			</inline>
			<inline>
				<a class="active" href = "index.php"> <u> <font color=white>Logon</font> </u> </a>
			</inline>
			<div class="weather">
				<img src="weather.png" style="height:35px"/>
			</div>
		</div>
	
	<div class="row">
		<div class="mainCenter">
		<div class="pictureFeedBox" > 
			<form onsubmit="return checkFields()" action ="index.php" method = "POST">
			<fieldset>
			<legend> Setup </legend>
					<label for="name" >Name</label>
					<br> 
					<input placeholder=" " type="text" name="name" id="name" autofocus onblur = "checkName(this)"
					required /> 
					<br> 
					<label for="password">Password</label>
					<br> 
					<input onblur = "checkPassword(this)" type="password" name="password"
					id="password" required  /> 
					<br>
					<label for="phone">Phone number</label>
					<br>
					<input placeholder= "+4512345678" onblur = "checkPhone()" type="text" name="phone" id="phone"
					required /> 
					<br> 
					<label for="email">Email address</label>
					<br>
					<input placeholder="Rasmus.Sørense@sdu.edu.dk" onblur = "checkEmail()" type="text" name="email" id="email"
					required />
					<br> 
					<label for="zip">Zip code</label>
					<br> 
					<input onblur = "checkZip()" type="number" name="zip" id="zip"
					required /> 
					<br> 
					<input type="submit" name="submit" id="submit"/> 
			</fieldset>
			</form>
		</div>	
		<div class="pictureFeedBox"> 
			Name: 
			<?php echo $_POST["name"]; ?>
			<br>
			Password:
			<?php echo $_POST["password"]; ?>
			<br>
			Phone Number:
			<?php echo $_POST["phone"]; ?>
			<br>
			Email Address: 
			<?php echo $_POST["email"]; ?>
			<br>
			Zip code:
			<?php echo $_POST["zip"]; ?>
		</div>
	</div>	
	
	<div class="side-column">
		<div class="add-side">
			<h1 style="font-size:3vw"> AD </h1>
		</div>
	</div>
		
	</body>
</html>
