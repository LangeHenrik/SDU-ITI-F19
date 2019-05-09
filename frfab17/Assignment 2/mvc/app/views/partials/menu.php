<html>

<head>
    <script src="../js/js.js"></script>
</head>

<body>

    <div style="background-color: lightblue;">
        <a href="/frfab17/mvc/public/picture/all">Pictures</a>
        <a href="/frfab17/mvc/public/upload">Upload Picture</a>
        <a href="/frfab17/mvc/public/users">Users</a>
        <span><?php echo $_SESSION['user'];?></span>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>

            <a style="float:right" href="/frfab17/mvc/public/user/logout">Log out</a>

        <?php endif; ?>
    </div>
</body>

</html>