<?php
	
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style12.css">
</head>

<body>

    <header>
        <nav>
            <div class="main-wrapper">
                <ul>
                    <li class="navli">
						<a href="index.php">Home</a>
						</li>
                
                    <?php
					
					if (isset($_SESSION['u_id'])) {
						echo "<li class='navli'><a href=\"users.php\">Users</a></li>";
						echo "<li class='navli'><a href=\"pictures.php\">Pictures</a></li>";
						echo "<li class='navli'><a href=\"upload.php\">Upload</a></li>";
					}
						?>

				
                </ul>


                <div class="nav-login">
                    <?php
					//ogin form!
					//check for a SESSION variable named "u_id". The "u_id" is created in our login script in login.inc.php, and will only exist if the user is logged in

					//If the user is logged in ("u_id" does exist), then we display the logout form
					if (isset($_SESSION['u_id'])) {
						echo '<form action="includes/logout.inc.php" method="POST">
							<button type="submit" name="submit">Logout</button>
						</form>';
					}
					//If the user is not logged in ("u_id" doesn't exist), then display the login form
					else {
						echo '<form action="includes/login.inc.php" method="POST">
							<input type="text" name="name" placeholder="Name">
							<input type="password" name="password" placeholder="password">
							<button type="submit" name="submit">Login</button>
						</form>
						<a href="signup.php">Sign up</a>';
					}
					?>
                </div>
            </div>
        </nav>
    </header> 