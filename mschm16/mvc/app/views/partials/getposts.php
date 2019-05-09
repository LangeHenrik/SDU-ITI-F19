<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styling/style.css">
</head>
<body>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid white;
        padding: 5px;
    }
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','itproject');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "SELECT * FROM posts 
        INNER JOIN user ON fk_userId = userId WHERE postId = '$q' 
        ORDER BY postId DESC";

$result = mysqli_query($con,$sql);

echo "<img src='mschm16/mvc/app/assets/img/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo()'>";
?>

<table>
    <tr>
        <th><p><b>Posted by (User ID)</b></p></th>
        <th><p><b>Posted by (username)</b></p></th>
        <th><p><b>Post ID</b></p></th>
    </tr>

<?php
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td> <p>" . $row['fk_userId'] . " </p></td>";
    echo "<td> <p>" . $row['userName'] . "</p></td>";
    echo "<td> <p>" . $row['postId'] . "</p></td>";
    echo "</tr>";
}
?>
</table>

<br>
<br>
<a href = '../home/index.php'>Go back</a>
<?php
mysqli_close($con);
?>
</body>
</html>