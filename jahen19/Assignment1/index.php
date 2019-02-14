<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>My Awesome Website</title>
    <meta charset="UTF-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no">
    <link href="main.css" rel="stylesheet">
    <script type="text/javascript" src="upload.js"></script>
  </head>
  <body>
      <header>
      <?php if (isset($_SESSION['username'])) { ?>
          <span id="hello-message">
              Hello <?php echo $_SESSION['username']; ?>!
          </span>
          <button id="logout-button" name="logout" type="submit" value="1">Logout</button>
      <?php } else { ?>
          <form id="userform" method="post" action="user.php">
              <input type="text" name="username" placeholder="Username..." required>
              <input type="password" name="password" placeholder="Password..." required>
              <input id="login-button" name="login" type="submit" value="Login">
              <input id="signup-button" name="signup" type="submit" value="Sign up">
          </form>
      <?php } ?>
      &nbsp;
    </header>

    <?php if (isset($_SESSION['username'])) { ?>
    <section id="form-wrapper">
      <form id="fileform" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col grid_1_of_3 right">
            Select picture:
          </div>
          <div class="col grid_2_of_3">
            <input type="file" name="file" autocomplete="off" required>
          </div>
        </div>
        <div class="row">
          <div class="col grid_1_of_3 right">
            Header:
          </div>
          <div class="col grid_2_of_3">
            <input type="text" name="header" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="col grid_1_of_3 right">
            Subtext:
          </div>
          <div class="col grid_2_of_3">
            <textarea name="subtext" autocomplete="off"></textarea>
          </div>
        </div>
        <div class="row" id="submit-wrapper">
            <input id="input-button" type="button" name="submit" value="Upload" onclick="send()">
        </div>
      </form>
    </section>
    <?php } else { ?>
    <section id="loginnotice">
          Please log in to upload and view images.
    </section
    <?php } ?>

    <hr>


    <main id='feed'>
    <?php
    if (isset($_SESSION['username'])) {

    require "sql.php";
    try  {
        $sql = "SELECT filename, header, text FROM Images"; // should probably LIMIT here
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
    ?>
        <figure>
            <figcaption><?php echo $row["header"]; ?></figcaption>
            <img src="./serve.php?filename=<?php echo $row["filename"]; ?>">
            <blockquote><?php echo $row["text"]; ?></blockquote>
        </figure>
    <?php
             }
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    }
    ?>
    </main>
  </body>
</html>
