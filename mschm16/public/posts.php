<?php include 'includes/top.php'; ?>

<h1>My Posts</h1>

<a class='reg' href='createPost.php'>Create post</a>
<div id='postDiv'>
<?php

$userPost = '';

    if (isset($_SESSION['login'])) {
        $userPost = $_SESSION['userId'];

        require_once 'includes/db.php';

            $sql = "SELECT * FROM posts WHERE fk_userId = '$userPost' ORDER BY postId DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data
                while($row = $result->fetch_assoc()) {
                    echo "<h3>" . $row['postName'] . "</h3>";
                    echo "<img src='assets/img/" . $row['postImg'] . "' alt='" . $row['postName'] . "'>";
                    echo "<p>" . $row['postText'] . "</p>";
                    echo "<a class='reg' href='deletePost.php?postId=" . $row['postId'] . "'>Delete</a>";
                }

                $conn->close();

            } else {
                echo '<p>You have made no posts yet.</p>';
            }
    } else {
        echo "<p>Not logged in.</p>";
    }
?>
</div>

<?php include 'includes/bot.php'; ?>