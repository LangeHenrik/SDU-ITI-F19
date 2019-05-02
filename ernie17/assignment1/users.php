<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    # Check login
    if(isset($_POST["logout"])) {
        header('location: index.php');
        session_destroy();
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        @$_SESSION['page_name'] = "Userpage";
    } else {
        echo "No user is currently logged in!";
        return;
    }

    include 'userLogin.php';
?>

<!-- Web site  -->
<html>
    <head>
        <title>Assignment 1</title>
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div class="block-search">
            <p class="header-search">Search for a user</p>
            <p>First name: <input type="text" onkeyup="showUsers(this.value)"></p>
            <table class="table-user" id="table-respons"></table>
        </div>

        <hr class="userpage-hr">

        <table class="table-user">
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
            </tr>
            <?php
                foreach ($resultGetUsers as $value) {
                    echo '<tr>';
                    echo '<td>' . $value['username'] . '</td>';
                    echo '<td>' . $value['firstname'] . '</td>';
                    echo '<td>' . $value['lastname'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>

        <?php include 'footer.php'; ?>
    </body>
</html>
