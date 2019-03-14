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
    <script type="text/javascript" src="script.js"></script>
  </head>
  <body>
      <header>
      <?php if (isset($_SESSION['username'])) { ?>
          <span id="hello-message">
              Hello <?php echo $_SESSION['username']; ?>!
              |
              <a href="user.php">See all users</a>
          </span>
          <form id="userform" method="post" action="user.php">
            <input id="logout-button" type="submit" name="logout" value="Logout">
          </form>
      <?php } else { ?>
          <a href="user.php">Create a new account</a>
          <form id="userform" method="post" action="user.php">
              <input type="text" name="username" placeholder="Username..." required>
              <input type="password" name="password" placeholder="Password..." required>
              <input id="login-button" name="login" type="submit" value="Login">
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
        if (isset($_GET['user'])) {
            // show only the images by $user
            $user = $_SESSION['username'];
            $sql = "SELECT filename, user, header, text FROM Images WHERE user = '$user' ORDER BY date DESC";
            echo "Your Images:<br> (<a href='./'>Go to global feed</a>)";
        } else {
            echo "Global Feed:<br> (<a href='?user=1'>Go to your feed</a>)";
            $sql = "SELECT filename, user, header, text FROM Images ORDER BY date DESC";
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
    ?>
        <figure id="<?php echo $row["filename"]; ?>">
            <!-- htmlspecialchars() avoids XSS attacks etc., see http://php.net/manual/en/function.htmlspecialchars.php -->
            <figcaption><?php echo htmlspecialchars($row["header"]); ?></figcaption>
            <img src="./serve.php?filename=<?php echo $row["filename"]; ?>">
            <blockquote><?php echo htmlspecialchars($row["text"]); ?></blockquote>
            <?php if ($row["user"] == $_SESSION["username"]) { ?>
            <button class="delete-button" type="submit" onclick="deletePicture(this)" value="<?php echo $row["filename"]; ?>">Delete</button>
            <?php } ?>
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
