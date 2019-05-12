<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
        <?php
            require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/top.php';
            $homecontroller = new HomeController();
        ?>
    </head>
    <body>
		<?php
			$username = $_POST['username'];
            $password = $_POST['password'];
            
			if (isset($_POST['submit'])) {
                $loginid = $homecontroller->login($username,$password);
				if ($loginid) {
                            $_SESSION["logged_in"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["userid"] = $loginid;
                            $warningtext = "";
                            header('Location: /pepak16/mvc/public');
                } else {
					$warningtext = "Wrong info.. Please try again.";
				}
			}
        ?>
		
        <div id="content">
            <h1>Login</h1>
            <form method="post" action="">
                <label title="Username">Username</label>
                <br>
                <br>
                <input type="text" name="username" id="username"/> 
                <br>
                <br>
                <label title="Password" for="password">Password</label>
                <br>
                <br>
                <input type="password" name="password" id="password"/> 
                <br>
                <br>
                <br>
                <br>
                <input type="submit" name="submit" id="submit" value="Submit"/> 
                <br>
                <br>
                <input type="button" value="Go back" onclick="history.back()">
                <br>
                <br>
            </form> 
            <?php 
                echo '<span style="color: red;">'.$warningtext.'</span>';
            ?>
        </div>
        <?php 
            include $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/bot.php'; 
        ?>
    </body>
</html>