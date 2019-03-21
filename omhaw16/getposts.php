<!DOCTYPE html>
<html>
<head>
    <script>

    function redirect() {
        window.location.href = "http://www.google.com";
    }

    </script>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','1608','itiproj');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// mysqli_select_db($con,"ajax_demo");
$sql = "SELECT * FROM posts INNER JOIN user ON postedby = userID WHERE postID 
= '$q' ORDER BY postID DESC";
// $sql="SELECT * FROM posts WHERE postID = '$q' ORDER BY postID DESC";

$result = mysqli_query($con,$sql);

echo "<img src='uploads/" . $row['imgName'] . "' alt='" . $row['imgTitle'] . "' onclick='imgInfo()'>";

echo "<table>
<tr>
<th>Posted by (User ID)</th>
<th>Posted by (username)</th>
<th>Post ID</th>
<th>Posted on</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['postedby'] . "</td>";
    echo "<td>" . $row['userName'] . "</td>";
    echo "<td>" . $row['postID'] . "</td>";
    echo "<td>" . $row['imgDate'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
echo "<br>";
echo "<a href = 'index.php'>Go back</a>";
// echo '<button type="button" onclick="redirect()""> Go back </button>';

mysqli_close($con);
?>

</body>
</html>