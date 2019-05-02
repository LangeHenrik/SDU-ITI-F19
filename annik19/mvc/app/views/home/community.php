<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <?php echo "<link rel='stylesheet' href='../../css/community.css'>"?>
</head>
<?php include_once('gethint.php')?>
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

<div class="container">
    <h2>Community</h2>
    <form>
        <h4>Search a user:</h4>
        <label>Username:</label>
        <input type="text" onkeyup="showHint(this.value)">

    <p> Suggestions: <span id="txt_hint"></span></p>
    </form>

<table class="table table-striped table-hover table-responsive" ">
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
                <td><?=$user[1]?></td>
                <td><?=$user[2]?></td>
                <td><?=$user[3]?></td>
                <td><?=$user[4]?></td>
                <td><?=$user[5]?></td>
                <td><?=$user[6]?></td>
                <td><?=$user[7]?></td>
            </tr>
    <?php $count += 1; } ?>
    </tbody>

</div>

</body>
</html>
