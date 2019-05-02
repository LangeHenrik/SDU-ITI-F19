<?php
include_once "../Controllers/feedController.php";
include_once "../Models/feed.php";


$model = new Feed();
$feedController = new feedController($model);
$feedController->liketoggle();

?>


<html lang="en">
<head>
    <link href="css/global.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>images</title>

    <script>


        function myFunction(x, image) {
            x.classList.toggle("fa-thumbs-down");
            $.ajax({
                url: 'feed.php',
                data: {action: 'true', image: image},
                type: 'post',
                success: function (output) {
                }
            });
        }

    </script>

</head>
<body>


<h1>Uploads</h1>
<?php
$feedController->getimages();
?>

</body>


</html>