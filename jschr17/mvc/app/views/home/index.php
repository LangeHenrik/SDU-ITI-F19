<?php
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Include config file
include_once "C:\Users\goope\Documents\GitHub\SDU-ITI-F19\jschr17\mvc\app\core\Database.php";

$database = new Database();
$conn = $database->getConn();

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        $sql_username = "SELECT username FROM users WHERE username = :param_username";
        $stmt1 = $conn->prepare($sql_username);
        if($conn->prepare($sql_username)){
            $stmt1->bindParam(':param_username', $param_username);
            $param_username = $username;
            if($stmt1->execute()){
                // Store result
                $username_values = $stmt1->fetchAll();
                $got_username= '';
                foreach($username_values as $_username){
                    $got_username = $_username['username'];
                }
                if($param_username === $got_username) {
                    $sql_password = "SELECT password FROM users WHERE username = :param_username";
                    $stmt2 = $conn->prepare($sql_password);
                    $stmt2->bindParam(':param_username', $param_username);
                    $stmt2->execute();
                    $password_values = $stmt2->fetchAll();
                    $got_hashed_password = '';
                    foreach ($password_values as $hashed_password) {
                        $got_hashed_password = $hashed_password['password'];
                    }
                    if(password_verify($password, $got_hashed_password)){
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        header("location: welcome");
                    } else{
                        $password_err = "The password you entered was not valid.";
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        form{ display: inline-block }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php /*echo htmlspecialchars($_SERVER["PHP_SELF"]);*/ ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="signup">Sign up now</a>.</p>
    </form>
</div>
</body>
</html>