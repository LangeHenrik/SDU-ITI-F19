<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../public/css/headerHomecss.css" />

</head>

<body>

  <div class="pageHeader">
    <h1>Hi, <?php echo htmlspecialchars($_SESSION["firstname"]); ?>!</h1>
    <div class="topnav">
      <nav>
        <a href="../home/home">Home</a>
        <a href="../user/showall">Users</a>
        <a href="../user/profile">Profile</a>
        <div class="login-container">
          <form action="peten17/mvc/public/user/logout" method="post">
            <button type="submit" name="logout">Log out </button>
          </form>
        </div>
      </nav>
    </div>
  </div>