<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="mvc/app/css/home.css">
    <link rel="stylesheet" type="text/css" href="mvc/app/css/users.css">
    <link rel="stylesheet" type="text/css" href="mvc/app/css/images.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <?php echo "<link rel='stylesheet' href='../css/users.css'>"?>
</head>
<script>
    function showHint(str){
        if (str.length === 0){
            document.getElementById("txt_hint").innerHTML="";
            return;
        } else {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState === 4 && this.status === 200){
                    document.getElementById("txt_hint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
            document.getElementById("txt_hint").innerHTML = "Loading...";
        }
    }
</script>
<?php include '../app/views/partials/menu.php'; ?>
<body>

<!--<div class="search_bar">-->
<!--<h2> Search a user: </h2>-->
<!--<form>-->
<!--    Username: <input type="text" onkeyup="showHint(this.value)">-->
<!--</form>-->
<!--<p> Suggestions: <span id="txt_hint"></span></p>-->
<!--</div>-->

<h2 style="margin: 4%">Community</h2>
<table class="table table-striped table-hover table-responsive" style="margin-left: 4%; margin-right:4%;" ">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">City</th>
        <th scope="col">ZIP</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $arr_users=$viewbag['all_users'];
    $count = 1;
    foreach ($arr_users as $user){
        ?>
            <tr>
                <th scope="row"><?=$count?></th>
                <td><?=$user[0]?></td>
                <td><?=$user[1]?></td>
                <td><?=$user[2]?></td>
                <td><?=$user[3]?></td>
                <td><?=$user[4]?></td>
                <td><?=$user[5]?></td>
                <td><?=$user[6]?></td>
            </tr>
    <?php $count += 1; } ?>
    </tbody>

</body>
</html>
