<?php

include '../app/views/partials/menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/gethint.js"></script>
</head>

<body>
    <div class="search">
        <form>
            <h2>Search for username:</h2> <input type="text" onkeyup="getHint(this.value)">
        </form>
        <p> Suggestions: <span id="hint"></span>
        </p>
    </div>
    <div class="usersTable" style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <td>Username</td>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>E-mail</td>
                    <td>Phone number</td>
                    <td>Zip code</td>
                    <td>City</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($viewbag as $value) {
                    echo '<tr>';
                    echo '<td>' . $value['username'] . '</td>';
                    echo '<td>' . $value['firstn'] . '</td>';
                    echo '<td>' . $value['lastn'] . '</td>';
                    echo '<td>' . $value['email'] . '</td>';
                    echo '<td>' . $value['phonenumber'] . '</td>';
                    echo '<td>' . $value['zip'] . '</td>';
                    echo '<td>' . $value['city'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>