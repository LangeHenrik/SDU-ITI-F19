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

$con = mysqli_connect('localhost','root','1608','itiproj');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "SELECT * FROM posts INNER JOIN user ON postedby = userID WHERE postID 
= '$q' ORDER BY postID DESC";

$result = mysqli_query($con,$sql);

echo "<img src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo()'>";

echo "<table>
<tr>
<th><p><b>Posted by (User ID)</b></p></th>
<th><p><b>Posted by (username)</b></p></th>
<th><p><b>Post ID</b></p></th>
<th><p><b>Posted on</b></p></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td> <p>" . $row['postedby'] . " </p></td>";
    echo "<td> <p>" . $row['userName'] . "</p></td>";
    echo "<td> <p>" . $row['postID'] . "</p></td>";
    echo "<td> <p>" . $row['imgDate'] . "</p></td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
echo "<br>";
echo "<a href = 'index.php'>Go back</a>";
mysqli_close($con);
?>

</body>
</html>