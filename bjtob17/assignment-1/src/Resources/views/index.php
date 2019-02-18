<?php
use Services\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Resources/css/style.css">
    <title>Title</title>
</head>
<body>
<div id="test">
bla
</div>
<?php
if (Auth::isLoggedIn()) {
    echo '<a href="/logout">logout</a>';
} else {
    echo '<a href="/login">login</a>';
}
?>
<script src="/Resources/js/js.js"></script>
</body>
</html>