<header style="display: inline-block; width: 100%; margin-top: 0px auto; padding: 10px; border-bottom: thin solid black;">
<?php if (isset($_SESSION['username'])) { ?>
     <span id="hello-message">
     Hello <?php echo $_SESSION['username']; ?>!
     </span>
     <form id="userform" method="post" action="/jahen19/mvc/public/home/logout" class="float-right">
     <input id="logout-button" type="submit" name="logout" value="Logout" class="btn btn-dark">
     </form>
<?php } else { ?>
     <a href="/jahen19/mvc/public/home/register">Create a new account</a>
     <form id="userform" method="post" action="/jahen19/mvc/public/api/login" class="float-right">
     <input type="text" name="username" placeholder="Username..." required>
     <input type="password" name="password" placeholder="Password..." required>
     <input id="login-button" name="login" type="submit" value="Login" class="btn btn-primary">
     </form>
<?php } ?>
</header>
