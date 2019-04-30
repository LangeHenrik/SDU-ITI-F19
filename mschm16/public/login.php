<?php include 'includes/top.php'; ?>

<?php 
    $name = "";
    $pass = "";

    $nameErr = "";
    $passErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $nameErr = "Username is required";
        } else {
            $name = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["password"])) {
            $passErr = "Password is required";
        } else {
            $pass = test_input($_POST["password"]);
        }

        if (!empty($_POST["password"]) && !empty($_POST["username"])) {
            require_once 'includes/db.php';

            $sql = "SELECT * FROM users WHERE userName = '$name' AND userPass = '$pass'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data
                while($row = $result->fetch_assoc()) {
                    $_SESSION['userId'] = $row["userId"];
                    $_SESSION['userName'] = $row["userName"];
                }

                $_SESSION['login'] = 1;

                $conn->close();
                /* Redirect */
                header("Location: index.php");
                exit;
            } else {
                echo "Wrong username or password";
            }

            $conn->close(); 
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h1>Login</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <span class="error"><?php echo $nameErr;?></span>
    <input type="text" name="username" id="uname" placeholder="Username">

    <span class="error"><?php echo $passErr;?></span>
    <input type="password" name="password" id="pass" placeholder="Password">
    
    <input type="submit" value="Login">
</form>

<a class='reg' href='register.php'>Register new user</a>

<?php include 'includes/bot.php'; ?>