<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Picture Page</title>
    <link href="/jonasr16/mvc/public/stylesheet.css" type="text/css" rel="stylesheet">
    <script src = "/jonasr16/mvc/public/change_tabs.js"></script>
</head>
<body>

<!-- Tab links -->
<div class="tab">
    <button class="tablinks" onclick="changeTab(event, 'PostPage', document.getElementsByClassName('tabcontent'),
    document.getElementsByClassName('tablinks'))">Post pictures</button>
    <button class="tablinks" onclick="changeTab(event, 'ViewPosts', document.getElementsByClassName('tabcontent'),
    document.getElementsByClassName('tablinks'))">View Posts</button>
</div>
<!-- Tab content -->
<div id="PostPage" class="tabcontent">
    <form action="/jonasr16/mvc/public/home/post_picture" method="post" enctype="multipart/form-data">
        Select image to upload: <br>
        <input type="file" name="fileToUpload" id="fileToUpload" required> <br> <br>
        Title of image: <br>
        <input type="text" name="title" id="titleOfImage" required><br> <br>
        Description of image: <br>
        <input type="text" name="description" id="descriptionOfImage" required><br> <br>
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <br>
    <form action= "/jonasr16/mvc/public/home/log_out" method="post">
        <button class="button buttonlogout" type="submit">Logout</button>
    </form>
    <br>
    Users (uses ajax): <br>
    <button><a id="button">Show all users</a></button>

    <p id="container"><!-- currently it's empty --></p>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a#button').click(function(){
                $.ajax({
                    url: '/jonasr16/mvc/public/Ajax/ajax_call',
                    success: function (response) {
                        $('#container').html(response);
                    }
                });
            });
        });
    </script>
</div>

<div id="ViewPosts" class="tabcontent">
    <?php if (isset($viewbag["pictures"])) {
        $images = $viewbag["pictures"];
        for ($x = 0; $x < sizeof($images); $x++) {
            echo $images[$x]['title'] . ' - By: ' . $images[$x]['username'];
            echo '<div class = "img">';
            $image = imagecreatefromstring(base64_decode($images[$x]['image']));
            ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
            imagejpeg($image, null, 80);
            $data = ob_get_contents();
            ob_end_clean();
            echo '<img src="data:' .  $images[$x]['extension'] .  ';base64,' .  base64_encode($data)  . '" />';
            echo '</div>';
            echo $images[$x]['description'];
            echo '<hr>';
        }
    } ?>
</div>
<div>
    <?php if (isset($viewbag["error_msg"])) {
        echo $viewbag["error_msg"];
    } ?>
</div>
</body>
</html>