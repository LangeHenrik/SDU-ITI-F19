<html>
    <head>
        <link rel="stylesheet" href="/krkin16/mvc/app/views/css/header_style.css">
    </head>
    <body>
        <div class = 'login'>
            <a href="index.php"><img src="/krkin16/mvc/app/images/logo.png"></a>
            <p>Welcome Home, <?=$viewbag["user"]?></p>
            <p id="user_name" class="hide"><?=$viewbag["user"]?></p>
            <p id="query_style" class="hide"><?=$viewbag["displayUser"]?></p>
            ?>
        </div>
    </body>

</html>
