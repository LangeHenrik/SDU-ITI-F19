<?php

require_once 'includes/db.php';

$sql = "SELECT * FROM posts 
        INNER JOIN users ON fk_userId = userId
        ORDER BY postId DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data
    while($row = $result->fetch_assoc()) {
        echo "<h3>" . $row['postName'] . "</h3>";
        echo "<img src='assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'>";
        echo "<p>" . $row['postText'] . "</p>";
        echo "<a class='reg' href='#'>Posted by " . $row['userName'] . "</a>";
    }

    $conn->close();

} else {
    echo '<p>There exists no posts yet.</p>';
}

?>