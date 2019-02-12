<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
</head>
<body>

<?php
if (isset($_POST['submit'])) {
    require "sql.php";
    try  {
        $username = $_POST['username'];
        // TODO: hash password
        $password  = $_POST['password'];

        // TODO: input sanitization
        // check username and password
        $sql = "SELECT username, password FROM Users WHERE username = '$username' AND password = '$password'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result && $statement->rowCount() == 1) {
            // create session cookie for user
            // $cookie = "random";
            // $sql = "INSERT INTO Users (cookie) values ($cookie)";

            // $statement = $conn->prepare($sql);
            // $statement->execute($new_user);

            $_SESSION['username'] = $username;
            $logged_in = $_SESSION['username'];

            echo "Hello $logged_in ! <a href='./index.php'>Continue to feed</a>";
        } else {
            echo "Username / Password unknown";
        }

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo '<form name="login" action="" method="post">
            Username:  <input type="text" name="username" value=""> <br>
            Password:  <input type="password" name="password" value=""> <br>
            <input type="submit" name="submit" value="Submit">
        </form>';
}
?>
    </body>
</html>
