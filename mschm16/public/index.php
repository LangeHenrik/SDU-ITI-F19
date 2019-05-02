<?php include 'includes/top.php'; ?>

<h1>Home</h1>
<?php 
    if (isset($_SESSION['login'])) {
        echo "<p>Welcome, " . $_SESSION['userName'] . "</p>";
    } else {
        echo "<p>Welcome, Guest</p>";
    }
?>
<button type="button" onclick="loadPosts()">Refresh posts</button>
<div id='postDiv'>
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
</div>

<script>
    function loadPosts() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("postDiv").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "fetchPosts.php", true);
        xhttp.send();
    }    
</script>

<?php include 'includes/bot.php'; ?>