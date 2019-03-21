<div id="nav">
    <ul class="menu">

    <?php

        $loginId = "";
        if (isset($_SESSION["login"])) { 
            $loginId = $_SESSION['login'];
        }

        if($loginId == 1) {
            echo "
                <li><a href='index.php' title='Home'><i class='fas fa-home'></i> Home</a></li>
                <li><a href='posts.php' title='Posts'><i class='fas fa-images'></i> My Posts</a></li>
                <li><a href='users.php' title='Users'><i class='fas fa-user-friends'></i> Users</a></li>
                <li><a href='logout.php' title='Logout'>" . $_SESSION['userName'] . " <i class='fas fa-sign-out-alt'></i></a></li>
            ";
        }
        else {
            echo "
                <li><a href='index.php' title='Home'><i class='fas fa-home'></i> Home</a></li>
                <li><a href='login.php' title='Login'>Guest <i class='fas fa-sign-in-alt'></i></a></li>
            ";
        }
    ?>
    
    </ul>
</div><!-- header ends -->