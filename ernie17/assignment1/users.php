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
        // echo "<h1>Welcome " . $_SESSION['username'] . "</h1>";
        // echo   "<form method='post'>
        //         <button name='logout'>Log out</button>
        //         </form>";

    } else {
        echo "No user is currently logged in!";
        return;
    }

    # establish db connection
    require_once 'db_config.php';

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $stmtGetUsers = $conn->prepare("SELECT username, firstname, lastname FROM picture_user");

        $stmtGetUsers->execute();
        $stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
        $resultGetUsers = $stmtGetUsers->fetchAll();
        // print_r($resultGetUsers);

        foreach ($resultGetUsers as $value) {
			if ($_SESSION['username'] === $value["username"]) {
				$firstname = $value["firstname"] . " ";
                $lastname = $value["lastname"];
				break;
			}
		}

    } catch (PDOexception $e) {
        echo "Error: " . $e->getMessage();
    }

	# Close db connection
	$conn = null;
?>

<!-- Web site  -->
<html>
    <head>
        <title>Assignment 1</title>
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    </head>
    <body>
        <h2 class="title">Welcome <?= $firstname, $lastname ?></h2>

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
    </body>
</html>
