

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Upload Images</title>
    <link href="/mifor16/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">
</head>

<body>
<h1>Upload Image</h1>
<nav id="nav">
    <a href="/mifor16/mvc/public/home/">INDEX</a>
    <a href="/mifor16/mvc/public/users/">USERS</a>
    <a href="/mifor16/mvc/public/upload/">UPLOAD</a>
    <a href="/mifor16/mvc/public/home/log_out">LOGOUT</a>
</nav>
<br><br><br><br>

<form action="/mifor16/mvc/public/Upload/upload" method="post" enctype="multipart/form-data">
    <div class="box">
        Select image to upload:<br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <br>
        <label>Image Label</label>
        <input type="text" placeholder="Title for Image" name="title">
        <label>Comment</label>
        <input type="text" placeholder="Description for Image" name="description">
        <input type="submit" value="Begin upload" name="submit">
        <!--<button type="submit" value="Submit Image">Submit Image</button>-->
    </div>
</form>
</body>

</html>
