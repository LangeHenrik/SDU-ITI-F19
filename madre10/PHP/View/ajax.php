<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajax</title>
    <link rel="stylesheet" type="text/css" href="/madre10css/main.css">
    <link rel="stylesheet" type="text/css" href="/madre10css/ajax.css">
    <?php echo '<script src="js/ajax.js"></script>'; ?>

</head>
<body>

<div class="container">
    <?php include(__DIR__.'/Components/NavigationBar.php'); ?>

    <div class="container">
        <div class="ajax_button" onclick="letsDoAjaxWithFetch()"> Click me for free Ajax!</div>
        <div id="ajax_container" class="ajax_container">
        </div>
    </div>
</div>



</body>
</html>