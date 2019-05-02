<!DOCTYPE html>
<html>
<head>
    <style>
        .button {
    display: inline-block;
    border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 28px;
            padding: 20px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
        }

        .button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
    padding-right: 25px;
        }

        .button:hover span:after {
    opacity: 1;
    right: 0;
}
    </style>
</head>
<body>


<form action="upload.php" method="post" enctype="multipart/form-data">
    <h1> Select image to upload: </h1>
Select Image File to Upload:
    <input class="button" type="file" name="file">
    <input class="button" type="submit" name="submit" value="Upload">
</form>




</body>
</html>
