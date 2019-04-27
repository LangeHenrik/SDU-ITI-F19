<header>
<?php if (isset($_SESSION['username'])) { ?>
     <span id="hello-message">
     Hello <?php echo $_SESSION['username']; ?>!
     </span>
     <form id="userform" method="post" action="./logout/">
     <input id="logout-button" type="submit" name="logout" value="Logout">
     </form>
<?php } else { ?>
     <a href="/jahen19/mvc/public/home/register">Create a new account</a>
     <form id="userform" method="post" action="/jahen19/mvc/public/api/login">
     <input type="text" name="username" placeholder="Username..." required>
     <input type="password" name="password" placeholder="Password..." required>
     <input id="login-button" name="login" type="submit" value="Login">
     </form>
<?php } ?>
&nbsp;
</header>
