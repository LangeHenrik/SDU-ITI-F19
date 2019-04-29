<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="../../css/home.css">
    <link rel="stylesheet" type="text/css" href="../../css/images.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?php echo "<link rel='stylesheet' href='../css/navbar.css'>"?>
    <?php echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\"
          integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\"
          crossorigin=\"anonymous\">"; ?>
</head>
<body>

<?php include '../app/views/partials/menu.php'; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1><div id="hello">Hello, <?=$viewbag['username']?></div></h1>
        </div>
        <div class="col-sm" style="text-align: right">
            <form action="logout" method="post">
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Upload your image</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="upload" id="upload" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label> Title </label>
                <input class="form-control" name="img_title" type="text">
                </div>
                <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="img_text" rows="2" cols="100"></textarea>
                </div>
                <div class="form-group">
                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <button type="submit" id="upload_button" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
</div>
<br><br>
<div id="main" class="container">
    <div class="row">
        <div class="col">
            <h4>Your pictures in a glance</h4>
        </div>
    </div>

    <?php
    $arr_img= $viewbag['ImagesTable'];
    $flag= true;
    if (!empty($arr_img)) {
        foreach ($arr_img as $img) { ?>
            <?php if ($flag == true) { ?>
                <div class="row">
            <?php } ?>
            <div class="col">
                <div id="images" class="card">
                    <a target="_blank" href="../<?= $img[4] ?>">
                        <img id="img-small" class="card-img-top" src="../<?= $img[4] ?>"></a>
                </div>
            </div>
            <?php $flag = true ? false : true; ?>
            <?php if ($flag == true) { ?>
                </div>
            <?php } ?>
        <?php }
    };
    ?> </div>

<br><br>
<div id="main" class="container">
    <div class="row">
        <div class="col">
            <h4>Explore your pictures</h4>
        </div>
    </div>
    <?php
    $arr_img= $viewbag['ImagesTable'];
    if(!empty($arr_img)) {
        foreach ($arr_img as $img) {?>
            <div class="row">
                <div class="col">
                    <div id="images" class="card">
                        <a target="_blank" href="../<?=$img[4]?>">
                            <img id="img" class="card-img-top" src="../<?= $img[4] ?>"></a>
                        <div class="card-body">
                            <h5 class="form-text text-muted">Title </h5>
                            <h5 class="card-title"><?=$img[1]?></h5>
                            <h5 class="form-text text-muted">Description </h5>
                            <p class="card-text"><?=$img[2]?> </p>
                            <form name="delete" method="post" action="../../../../delete.php">
                                <input class="form-control" type="hidden" name="image_path" value="../<?=$img[4]?>">
                                <button class="btn btn-danger" type='submit' value="Delete" id="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
    };
    ?>
</div>
</body>
</html>
