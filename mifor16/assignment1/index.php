<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<?php echo '<p>Hello World</p>'; ?>
</body>
</html>