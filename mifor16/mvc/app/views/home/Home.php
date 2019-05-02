<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Index</title>
<link href="/mifor16/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<h1>Index</h1>
<nav id="nav">
    <a href="/mifor16/mvc/public/home/">INDEX</a>
    <a href="/mifor16/mvc/public/users/">USERS</a>
    <a href="/mifor16/mvc/public/upload/">UPLOAD</a>
    <a href="/mifor16/mvc/public/home/log_out">LOGOUT</a>
</nav>
<br><br><br><br>

<?php if (isset($viewbag["pictures"])) {
    $latestimages = $viewbag["pictures"];
    for ($item = 0; $item <= sizeof($latestimages) - 1; $item++) {
        echo '<div class="boxyInside">';
        echo '<h2>' . $latestimages[$item]['title'] . '</h2>';
        echo '<h5>' . 'Submitted by: ' . $latestimages[$item]['username'] . '</h5>';

        echo '<div class="resize">';
        echo '<img src="' . $latestimages[$item]['imageString'] . '" />';
        echo '</div>';
        echo '<h4>' . 'Description:' . '</h4>' . $latestimages[$item]['description'];
        echo '</div>';
    }
} ?>


</body>
</html>