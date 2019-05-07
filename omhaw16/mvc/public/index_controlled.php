<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> PhotoPost </title>
  <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
  <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
</head>

<body>

<h1> Welcome to PhotoPost! </h1>

<p class = 'tagline'> - Your photo-sharing website </p>

   <div class = "login" <?php echo $stylelog;?>>
    <form name ="loginform" action="#" method="post">
    <label for="name" style="color: white;">Name</label>
    <br> 
    <input type="text" name="user" id="user"/> 
    <br>
    <span class="error"><?php echo $usernameErr;?></span>
    <br>
    <label for="password">Password</label>
    <br> 
    <input type="password" name="pw" id="pw"/> 
    <br>
    <br>
    <input type="submit" name="submitme" id="submitme"/>
    <br>
    <p> Not registered yet? Click <a href="/omhaw16/mvc/app/views/home/register.php">here!</a> </p>
</div>

</body>

</html>