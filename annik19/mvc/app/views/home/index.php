<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <?php echo "<link rel='stylesheet' href='../css/navbar.css'>"; echo "
    <link rel='stylesheet' href='../css/index.css'>";?>
</head>
<?php include '../app/views/partials/menu.php';?>

<h1 style="margin-top:5%; font-family: 'Lobster', cursive; text-align: center;">Welcome to AEκόvες</h1>
<h4 style="text-align: center;">Your place for your pictures!</h4>

<?php if (!empty($viewbag['error']))  { ?>
    <h5 style="text-align: center; margin-top: 5%; color: red"> <?=$viewbag['error']?> </h5>
<?php }?>


</html>