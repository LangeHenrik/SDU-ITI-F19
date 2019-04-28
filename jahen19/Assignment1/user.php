<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Login & Sign Up</title>
  </head>
  <body>

<?php
require "sql.php";

function leave() {
    echo "</body></html>";
    exit();
}

// username may only contain letters A-Z and digits 0-9, maximum length 30 chars
function check_username($str) {
    if (strlen($str) <= 0 || strlen($str) > 30) {
        return false;
    }
    return preg_match('/^[a-zA-Z0-9]*$/', $str);
}

try  {
    if (isset($_POST['signup'])) {
        // create new account for user
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password-repeat'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $zipcode = $_POST['zip'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // basic input validation
        if (!check_username($username)) {
            echo "Please choose a different username.<br>";
            leave();
        }
        if (strlen($password) < 6) {
            echo "Password should have at least 6 characters.<br>";
            leave();
        }
        if ($password !== $password_repeat) {
            echo "Passwords don't match.<br>";
            leave();
        }

        // see https://secure.php.net/manual/en/function.password-hash.php
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // check if username is already in use
        $sql = "SELECT username FROM Users WHERE username = :username";
        $statement = $conn->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result && $statement->rowCount() > 0) {
            // user already exists
            echo "Please choose a different username.<br>";
        } else {
            // create new entry for user
            $sql = "INSERT INTO Users (username, password, firstname, lastname, zipcode, city, email, phone) values (:username,:password, :firstname, :lastname, :zipcode, :city, :email, :phone)";
            $statement = $conn->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->bindParam(":password", $hashed_password);
            $statement->bindParam(":firstname", $firstname);
            $statement->bindParam(":lastname", $lastname);
            $statement->bindParam(":zipcode", $zipcode);
            $statement->bindParam(":city", $city);
            $statement->bindParam(":email", $email);
            $statement->bindParam(":phone", $phone);
            $statement->execute();

            // automatically log user in
            $_SESSION['username'] = $username;

            echo "Successfully created new user $username<br>";
            echo "<a href='./'>Click here to go to your feed</a>";
        }
    } elseif (isset($_POST['login'])) {
        // log user in

        $username = $_POST['username'];
        $password  = $_POST['password'];

        // basic input validation
        if (!check_username($username)) {
            echo "Invalid username. <br>";
            leave();
        }

        // fetch username and password from database
        $sql = "SELECT username, password FROM Users WHERE username = :username";
        $statement = $conn->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $result = $statement->fetchAll();
        // check password
        if ($result && $statement->rowCount() == 1
            && password_verify($password, $result[0]['password'])) {
            $_SESSION['username'] = $username;
            $logged_in = $_SESSION['username'];

            echo "Hello $logged_in!<br>";
            echo "<a href='./'>Click here to go to your feed</a>";
        } else {
            echo "Username or Password unknown<br>";
            echo "<button onclick='window.history.back()'>Go Back</button>";
        }

    } elseif (isset($_POST['logout'])) {
        // terminate user session
        $_SESSION['username'] = NULL;
        echo "Goodbye!<br>";
        echo "<a href='./'>Click here to go to the main site</a>";
    } else {
        // if user is logged, show all Users
        if (isset($_SESSION['username'])) {
            echo "<a href='./'>Go to the main feed</a><br><br>";

            $sql = "SELECT username, firstname, lastname, zipcode, city FROM Users";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(); ?>

            <table style="border: 1px solid black;">
              <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Location</th>
              </tr>

            <?php
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) { ?>
              <tr>
              <!-- htmlspecialchars() avoids XSS attacks etc., see http://php.net/manual/en/function.htmlspecialchars.php -->
                <td> <?php echo $row["username"]; ?> </td>
                <td> <?php echo htmlspecialchars($row["firstname"]); ?> </td>
                <td> <?php echo htmlspecialchars($row["lastname"]); ?> </td>
                <td> <?php echo htmlspecialchars($row["city"]); ?> </td>
              </tr>
           <?php } } ?>

           </table>

           <?php  } else { // show signup form ?>
           <form id="userform" method="post" action="user.php">
               <input type="text" name="username" placeholder="Username..." required>
               <br>
               <input type="password" name="password" placeholder="Password..." required>
               <br>
               <input type="password" name="password-repeat" placeholder="Repeat Password..." required>
               <br>
               <input type="text" name="firstname" placeholder="Firstname...">
               <br>
               <input type="text" name="lastname" placeholder="Lastname...">
               <br>
               <input type="text" name="zip" placeholder="ZIP Code...">
               <br>
               <input type="text" name="city" placeholder="City...">
               <br>
               <input type="text" name="email" placeholder="Email...">
               <br>
               <input type="text" name="phone" placeholder="Phone...">
               <br>
               <input id="signup-button" name="signup" type="submit" value="Sign up">
           </form>
           <?php
           }

         }

      } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
      }

      ?>
    </body>
</html>
