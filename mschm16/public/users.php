<?php include 'includes/top.php'; ?>

<h1>Users</h1>
<p>Users registered and the amount of posts they have.</p>
<table>
<tr>
    <th>Username</th>
    <th>Total Posts</th>
</tr>
<?php 
    require_once 'includes/db.php';

    $sql = "SELECT * FROM users ORDER BY userName ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data
        while($row = $result->fetch_assoc()) {
            $userIdPosts = $row["userId"];

            echo "<tr>";
            echo "<td>" . $row["userName"] . "</td>";

            $sql2 = "SELECT COUNT(*) AS total FROM posts
                     INNER JOIN users ON fk_userId = userId
                     WHERE fk_userId = '$userIdPosts'";

            $result2 = $conn->query($sql2);

            $row2 = $result2->fetch_assoc();

            $num_rows = $row2['total'];

            echo "<td>" . $num_rows . "</td>";
            echo "</tr>";
        }

        $conn->close();

    } else {
        echo "<tr>";
        echo "<td>No Users found</td>";
        echo "</tr>";
    }
?>
</table>

<?php include 'includes/bot.php'; ?>