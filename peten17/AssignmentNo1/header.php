<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
  }

if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("location:index.php");

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/headerStyle.css" />
  </head>

  <body>
    <script>
      function changeTitle(){
        
      }

    </script>



    <div class="pageHeader">
      <h1>Hi, <?php echo htmlspecialchars($_SESSION["firstname"]); ?>!</h1>
    <div class="topnav">
      <nav>


      <a href="startpage.php">Home</a>
      <a href="users.php">Users</a>
      <a href="profile.php">Profile</a>
      <div class="login-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="logout">Log out </button>
        </form>
      </div>
      </nav>
    </div>
  </div>





  </body>
</html>
