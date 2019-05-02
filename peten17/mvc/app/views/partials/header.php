<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/peten17/mvc/public/css/style.css" />
</head>

<body>

  <div class="pageHeader">
    <h1>Hi, <?php echo $_SESSION["firstname"]; ?>!</h1>
    <div class="topnav">

      <nav>
        <a href="/peten17/mvc/public/picture/all">Home</a>
        <a href="/peten17/mvc/public/user">Users</a>
        <a href="/peten17/mvc/public/home/profile">Profile</a>
        <div class="login-container">
          <form action="/peten17/mvc/public/home/logout" method="post">
            <button type="submit" name="logout">Log out </button>
          </form>
        </div>
      </nav>
    </div>
 