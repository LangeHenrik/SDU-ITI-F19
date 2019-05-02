<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="Login.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  </style>
</head>
<body>
<div class="Login">

  <form action="includes/loginhandler.php" method="post" onsubmit="return checkFields()">
    <input type="text" name="username" placeholder="Username" id="username">
    <br>
    <input type="password" name="password" placeholder="Password" id="password">
    <br>
    <button type="submit" name="login">Login</button>
    <br>
  </form>
    <a href="RegisterUser.php"> Not yet registered click here</a>

  </div>
</body>
</html>
