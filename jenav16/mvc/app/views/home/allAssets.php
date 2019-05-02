<!DOCTYPE html>
<html>
<head>
    <title>ITI 1.0</title>
    <meta charset="UTF-8"/>
    <link href="../../../CSS/main.css" rel="stylesheet">
    <script src="../../../JS/search.js" type="text/javascript"></script>
</head>
<body>

<?php if (isloggedIn()) { ?>

    <script>
        assetSearch('')
    </script>
    <form>
        Search for an image: <input type="text" onkeyup="assetSearch(this.value)">
    </form>
    <span id="txtHint"></span>
    <button onclick='window.history.back()'>Back to the Asset screen</button>


<?php } else{
    echo "<button onclick='window.history.back()'>Go back</button>" . "<br>";
    die("You need to login before you can see assets");

}

function isloggedIn()
{
    return isset($_SESSION['username']);
}
?>


</body>
