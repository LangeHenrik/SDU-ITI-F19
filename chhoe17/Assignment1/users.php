<?php
include_once 'header.php';
include 'includes/db_config.php';
require 'includes/db_config.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Users</h2>
        <?php
            //Check if user is logged in
        if (isset($_SESSION['u_id'])) {
            echo "User list!";

            $query = $conn->query('SELECT * FROM users')->fetchAll();
            ?>
        <ul>
            <?php
            foreach ($query as $query) {
                ?>
            <li>
                <?php
                echo $query['user_name'];
                ?>
            </li>
            <?php

        }
        ?>
        </ul>

        <body>
            <button onclick=refreshData()>Say Hello</button>
            <div id="content" />
        </body>

        <?php
        print "<p>Hello World</p>";
        ?>

        <head>
            ...
            <script type="text/javascript">
                function refreshData() {
                    var display = document.getElementById("content");
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "hello.php");
                    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp.send();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            display.innerHTML = this.responseText;
                        } else {
                            display.innerHTML = "Loading...";
                        };
                    }
                }
            </script>
            ...
        </head>

        <?php

    }
    ?>
    </div>
</section>

<?php
include_once 'footer.php';
?> 