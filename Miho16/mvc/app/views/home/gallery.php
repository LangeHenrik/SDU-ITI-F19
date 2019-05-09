<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <meta charset="UTF-8"/>
</head>
<body>

<?php if (isloggedIn()) {
if ($viewbag['gallery'] != null) {
foreach ($viewbag['gallery'] as $asset) {
    ?>
    <figure id="<?php echo $asset["fileID"]; ?>">
        <b>
            <figcaption><?php echo $asset["headline"]; ?></figcaption>
        </b>
        <img src=<?php echo '../../../upload/' . $asset["fileID"]; ?>>
        <?php echo $asset["text"]; ?> <br>
        <?php if ($asset["username"] == $_SESSION["username"]) { ?>
            <form action="/Miho16/mvc/public/home/delete" enctype="multipart/form-data" id="fileForm" method="post">
                <input type="hidden" name=fileID value='<?php echo $asset["fileID"]; ?>'/>
                <br><input id="deleteAssetButton" name="deleteAsset" type="submit"
                           value="Delete <?php echo $asset["headline"]; ?>"><br>
            </form>
        <?php } ?>
    </figure>
<?php
}
}

    ?>

    <script>
        assetSearch('')
    </script>
    <form>
        Search for an image: <input type="text" onkeyup="assetSearch(this.value)">
    </form>
    <span id="txtHint"></span>
    <button onclick='window.history.back()'>Back</button>


<?php } else{
    echo"login to see images";
    echo "<button onclick='window.history.back()'>Back</button>" . "<br>";
    die();
}
function isloggedIn()
{
    return isset($_SESSION['username']);
}
?>


</body>
