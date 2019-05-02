<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
     <link rel="stylesheet" href="/dpete17/mvc/app/views/main-style.css">
    <link rel="stylesheet" href="/dpete17/mvc/app/views/dashboard/dashboard-style.css">
    <script src="/dpete17/mvc/app/views/dashboard/opinion-action.js"></script>
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Project A01</h1>
            <ul>
                <li><a href="../">Your Images</a></li>
                <li><a class="active" href="">Uploaded Images</a></li>
                <li><a href="accounts">View All Accounts</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </header>
        <div class="dashboard-body">
            <div style="text-align: center;"><span id="message">
                <?php

                    if(isset($_SESSION['MESSAGE'])) {
                        echo $_SESSION['MESSAGE'];
                        unset($_SESSION['MESSAGE']);
                    }

                ?>
            </span></div>
            <hr>
            <div class="image-container">
                <?php
                
                foreach ($viewbag['images'] as $image) {
                    if(substr($image -> base64, 0, strlen('data')) != 'data') {
                        $src = '<img src="data:'.$image -> getMimeType().';base64,'.$image -> base64.'" alt="Error.." >';
                    } else {
                        $src = '<img src="'.$image -> base64.'" alt="Error.." >';
                    }

                    echo <<<EOL
                        <div>
                            <p>Created by: {$image -> user}</p>
                            <p>Uploaded at: {$image -> uploaded_at}</p>
                            <h2>{$image -> header}</h2>
                            <span>{$image -> content}</span>
                            <br>
                            {$src}
                            <div class="opinions">
                                <a href="javascript:void(0);" onclick="onOpinion(this, 'LIKES')" data-id="{$image -> id}"><i class="fas fa-heart like"></i><p id="likes{$image -> id}">{$image -> likes}</p></a>
                                <a href="javascript:void(0);" onclick="onOpinion(this, 'DISLIKES')" data-id="{$image -> id}"><i class="fas fa-heart dislike"></i><p id="dislikes{$image -> id}">{$image -> dislikes}</p></a>
                            </div>
                        </div>
                        <hr>
                    EOL;
                
                }

                ?>
            </div>
        </div>
        <?php include('../app/views/partials/main-footer.php'); ?>
    </div>
</body>
</html>