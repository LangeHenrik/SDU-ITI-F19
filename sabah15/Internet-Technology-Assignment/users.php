<?php
require "header.php";
?>


<main>
    <table id="users">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
        </tr>
        <?php
        include_once 'resources/databaseHandler.res.php';


        $sql = "SELECT uidUsers, emailUsers, firstNameUsers, lastNameUsers, cityUsers FROM users;";
        $statement = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL statement failed!";
        }
        else {
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>'.$row['uidUsers'].'</td>
                        <td>'.$row['emailUsers'].'</td>
                        <td>'.$row['firstNameUsers'].'</td>
                        <td>'.$row['lastNameUsers'].'</td>
                        <td>'.$row['cityUsers'].'</td>
                    </tr>';
            }
        }


        ?>




    </table>

</main>

<?php
require "footer.php";
?>
