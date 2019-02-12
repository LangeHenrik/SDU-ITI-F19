<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    require "sql.php";
    try  {
        $username = $_POST['username'];
        // TODO: hash password
        $password = $_POST['password'];

        $sql = "SELECT username FROM Users WHERE username = '$username'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result && $statement->rowCount() > 0) {
            // user already exists
            echo "Please choose a different username<br>";
            exit();
        }

        $sql = "INSERT INTO Users (username, password) values ('$username', '$password')";
        $statement = $conn->prepare($sql);
        $statement->execute();

        echo "Success! <a href='./login.php'>Login to continue</a>";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo '<form name="signup" action="" method="post">
            Username:  <input type="text" name="username" value=""> <br>
            Password:  <input type="password" name="password" value=""> <br>
            <input type="submit" name="submit" value="Submit">
        </form>';
}
?>
    </body>
</html>
