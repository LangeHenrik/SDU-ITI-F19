<? include '../app/views/partials/menu.php'; ?>
<style><?include("css/homepage.css");?></style>
<style><?include("css/bootstrap.css");?></style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHOTO WALL</title>
</head>
<body>
        <div id="landing">
            <div id="landing-text">
                <div id="landing-text-inner">
                    <h1><b>PHOTO WALL</b></h1>
                    <h6>EXPLORE STUNNING PHOTOGRAPHS</h6>
                </div>
            </div>
        </div>

        <div class = "container">
        <form class = "form-upload" role = "form"
              name="uploadform" enctype="multipart/form-data" method = "post">

            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>

            <input type = "text" class = "form-control"
                   name = "title" placeholder = "Enter photo title" required></br>

            <input type = "text" class = "form-control"
                   name = "description" placeholder = "Enter photo description" required></br>

            <input type='file' name='file'>

            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                    name = "upload">Upload</button>
        </form>
    </div>

<?php
    if($viewbag) {
        foreach($viewbag as $picture) 
        {
            $photo = $picture['Picture'];
            $title = $picture['Title'];
            $description = $picture['Description'];
            $user = $picture['Username'];
            $uploadedAt = $picture['Uploaded_At'];

            $first = $picture['First_Name'];
            $last = $picture['Last_Name'];
            //echo '<img src="data:image/jpeg;base64,'.($picture['Picture'] ).'"/>';
            //<img src='."data:image/jpeg;base64,$photo".'> 
            print '                  
                <img src='."data:image/jpeg;base64,$photo".'> 
                <div class="caption">
                    <h3>'."$title".'</h3>
                    <p>'."$description".'</p>
                    <p>'."$first $last".'</p>
                    <p><small> Uploadd by '."$user $uploadedAt".'</small></p>
                </div>
            ';
        }
    }
?>
</body>
</html>
