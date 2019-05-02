<?php echo '<link href="css/NavigationBar.css" rel="stylesheet" type="text/css" >'; ?>

<div class="navigation_bar__wrapper">
    <div class="navigation_bar__button" onclick="location.href='/madre10/feed'"> Feed</div>
    <div class="navigation_bar__button" onclick="location.href='/madre10/images'"> My Images</div>
    <div class="navigation_bar__button" onclick="location.href='/madre10/me'"> My page</div>
    <div class="navigation_bar__button" onclick="location.href='/madre10/users'"> Users</div>
    <div class="navigation_bar__button" onclick="location.href='/madre10/ajax'"> Ajax!</div>
    <?php
    if( isset($_SESSION['user_id']) ){
       echo " <div class=\"navigation_bar__button\" onclick=\"location.href='/madre10/logout'\">Logout</div>";
    } else {
        echo "<div class=\"navigation_bar__button\" onclick=\"location.href='/madre10/login'\"> Login</div>";
    }
    ?>
</div>