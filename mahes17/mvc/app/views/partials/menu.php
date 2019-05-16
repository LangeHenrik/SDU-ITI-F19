<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="w3-bar w3-blue">
        <a href="picture" class="w3-bar-item w3-button w3-mobile">All pictures</a>
        <a href="users" class="w3-bar-item w3-button w3-mobile">Users</a>
        <a href="upload" class="w3-bar-item w3-button w3-mobile">Upload picture</a>
        <a href="profile" class="w3-bar-item w3-button w3-mobile">My pictures</a>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
            <a href="user/logout" class="w3-bar-item w3-button w3-mobile w3-right">Logout</a>
        <?php endif; ?>

        <a href="profile" class="w3-bar-item w3-button w3-mobile w3-left"><?php echo $_SESSION['user']; ?></a>
    </div>
</body>
