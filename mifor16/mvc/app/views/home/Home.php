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
        $image = imagecreatefromstring($latestimages[$item]['blob_data']);
        ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
        imagejpeg($image, null, 80);
        $data = ob_get_contents();
        ob_end_clean();
        echo '<img src="data:image/jpg;base64,' . base64_encode($data) . '" />';
        echo '</div>';
        echo '<h4>' . 'Description:' . '</h4>' . $latestimages[$item]['description'];
        echo '</div>';
    }
} ?>


</body>
</html>