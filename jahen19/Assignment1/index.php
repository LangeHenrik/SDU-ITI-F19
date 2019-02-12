<?php
session_start();

if(isset($_GET['logout'])) {
    $_SESSION['username'] = NULL;
    echo "Successfully logged out.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Awesome Website</title>
<meta charset="UTF-8">
<script type="text/javascript" src="upload.js"></script>
<style>
#wrapper-form {
display: block;
     }
#loading {
display: none;
}
#finished {
display: none;
}
</style>
</head>
<body>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hello $username!";
    echo '<a href="?logout=1">Click here to log out</a>';
} else {
    echo '<a href="./signup.php">Click here to sign up</a><br><a href="./login.php">Click here to log in</a>';
    echo '</body></html>';
    exit();
}

?>

<div id="wrapper-form" class="text block">
  <form id="fileform" method="post" enctype="multipart/form-data">
    Select picture:
    <input type="file" name="file" autocomplete="off">
    <br>
    Header:
    <input type="text" name="header" autocomplete="off">
    <br>
    Subtext:
    <input type="text" name="subtext" autocomplete="off">
    <br>
    <input id="input-button" type="button" value="Upload" onclick="send()">
  </form>
</div>
<br>
<div id="loading" class="text block">
  Please stand by...
  <br>
<video loop muted autoplay height="300"
                    src="https://files.mastodon.social/media_attachments/files/010/470/067/original/f208c1e49ef2c4bc.mp4">
  Sorry, your browser doesn't support embedded videos.
</video>

</div>
<div id="finished" class="text block">
  Success!
</div>

</body>
</html>
