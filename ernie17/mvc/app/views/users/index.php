<?php include '../app/views/partials/head.php'; ?>

<?php include '../app/views/partials/header.php'; ?>

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
        foreach ($viewbag['users'] as $value) {
            echo '<tr>';
            echo '<td>' . $value['username'] . '</td>';
            echo '<td>' . $value['firstname'] . '</td>';
            echo '<td>' . $value['lastname'] . '</td>';
            echo '</tr>';
        }
    ?>
</table>

<?php include '../app/views/partials/footer.php'; ?>

<?php include '../app/views/partials/foot.php'; ?>
