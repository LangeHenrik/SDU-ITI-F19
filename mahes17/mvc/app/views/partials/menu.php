<html>
    <head>
    <script src="../js/js.js"></script>
    </head>
    <body>

<div style="background-color: lightblue;"> Menu partial view</div>

<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>

<a href="/mahes17/mvc/public/user/logout"> Log out</a>

<?php endif; ?>
