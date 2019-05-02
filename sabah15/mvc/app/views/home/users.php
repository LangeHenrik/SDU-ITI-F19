<?php
include "../app/views/partials/header.php";
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
        foreach ($viewbag["users"] as $user) {
            echo '<tr>
                <td>'.$user->username.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->firstname.'</td>
                <td>'.$user->lastname.'</td>
                <td>'.$user->city.'</td>
            </tr>';
        }
        ?>

    </table>

</main>

<?php
include "../app/views/partials/footer.php";
?>
