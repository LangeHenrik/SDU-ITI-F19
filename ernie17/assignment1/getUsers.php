<?php
    # establish db connection
    require_once 'db_config.php';

    try {
        $request = $_REQUEST['request'] . '%';

        $conn = new PDO("mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $stmtGetUsers = $conn->prepare("SELECT picture_user_id, username, firstname, lastname FROM picture_user WHERE firstname LIKE :request");
        $stmtGetUsers->bindparam(':request', $request);

        $stmtGetUsers->execute();
        $stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
        $resultGetUsers = $stmtGetUsers->fetchAll();
        // print_r($resultGetUsers);

        echo "<table>
        <tr>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        </tr>";

        foreach ($resultGetUsers as $value) {
            echo '<tr>';
            echo '<td>' . $value['username'] . '</td>';
            echo '<td>' . $value['firstname'] . '</td>';
            echo '<td>' . $value['lastname'] . '</td>';
            echo '</tr>';
        }

        echo "</table>";

    } catch (PDOexception $e) {
        echo "Error: " . $e->getMessage();
    }

    # Close db connection
    $conn = null;
?>
