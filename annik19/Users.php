<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="users.css">
    <link rel="stylesheet" type="text/css" href="images.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
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
<body>
<div id="navigation">
    <a href=Images.php>My Images</a>
    <?php if (isset($_SESSION['user'])) { ?>
        <a href=Login.php>Logout</a>
    <?php } else { ?>
        <a href=Login.php>Login</a>
    <?php } ?>
    <a href="Users.php">Community</a>
</div>
<div class="title">AEkόvεs</div>
<div class="search_bar">
<h2> Search a user: </h2>
<form>
    Username: <input type="text" onkeyup="showHint(this.value)">
</form>
<p> Suggestions: <span id="txt_hint"></span></p>
</div>

<form method="post">
    <input type="submit" value="All users" name="all_users">
</form>
<table>
    <thead>
    <tr>
        <td>Username</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>City</td>
        <td>ZIP</td>
        <td>Email</td>
        <td>Phone</td>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_POST["all_users"])) {
        require_once "config.php";
        $sql = "select username, fname, lname, city, zip, email, phone from user;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            ?>
            <tr>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[2] ?></td>
                <td><?php echo $row[3] ?></td>
                <td><?php echo $row[4] ?></td>
                <td><?php echo $row[5] ?></td>
                <td><?php echo $row[6] ?></td>
            </tr>
            <?php
        }
    }
            ?>
    </tbody>
</body>
</html>
