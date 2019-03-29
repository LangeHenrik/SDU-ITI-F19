<!DOCTYPE html>
<html>
    <head>
        <title>Sign-up page</title>
        <!-- <script>

            //function that checks whether all fields live up to specific constraints
            function checkFields() {

                //variables initializes input from fields
                var name = document.getElementById("name").value;
                // var password = document.getElementById("password").value;
                var phone = document.getElementById("phone").value;
                // var email = document.getElementById("email").value;
                // var zip = document.getElementById("zip").value;

                var passwordConstraint = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/g;
                var phoneConstraint = /^\+{1}[0-9]/;

                //checking constraints
                //if (passwordConstraint.test(password)) {
                if (true) {
                    if (phoneConstraint.test(phone)) {
                        return true;
                    } else {
                        alert("Please check field constraints and try again");
                        return false;
                    }
                } else {
                    alert("Please check field constraints and try again");
                    return false;
                }
            }
        </script> -->
    </head>
    <body>
        <?php 
            include 'top.php';
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $phonenumber = $_POST['phone'];
            $email = $_POST['email'];
            $zipcode = $_POST['zip'];


            if (isset($_POST['submit'])) {
                if (trim($username) == '' || trim($password) == '' || trim($phonenumber) == '' || trim($email) == '' || trim($zipcode) == '') {
                    $warningtext = "Please fill the whole form.<br><br>";
                } else {
                    if ($password == $password_confirm) {
                        if (registerUser($username, $password, $phonenumber, $email, $zipcode)) {   
                            $_SESSION["logged_in"] = true;
                            $warningtext = "";
                            header('Location: succes_page.php');
                        } else {
                            $warningtext = "Cannot register user.. Something went wrong. Please try again.<br><br>";
                        }
                    }
                }
            }
        ?>

        <div id="content">
        <h1>User Registration</h1>
        <?php echo '<span style="color: red;"><i>'.$warningtext.'</i></span>'; ?>
        <form method="post" action="">
                <label title="Username">Username</label>
                <br>
                <br>
                <input type="text" name="username" id="username"/> 
                <br>  
                <br>
                <label title="Password must contain 8 or more chars. At least one lower case char. At least one upper case char. At least one number.
                " for="password">Password</label>
                <br>
                <br>
                <input type="password" name="password" id="password"/> 
                <br>
                <br>
                <label title="Password" for="password">Confirm password</label>
                <br>
                <br>
                <input type="password" name="password_confirm" id="password_confirm"/> 
                <br>
                <br>
                <label for="phone">Phone number</label>
                <br>
                <br>
                <input type="text" name="phone" id="phone"/> 
                <br>
                <br>
                <label for="email">E-mail address</label>
                <br>
                <br>
                <input type="text" name="email" id="email"/>
                <br>
                <br>
                <label for="zip">Zip code</label>
                <br> 
                <br>
                <input type="text" name="zip" id="zip"/> 
                <br><br><br>
                <input type="submit" name="submit" id="submit" value="Submit"/> 
                <br> 
                <br>
                <input type="button" value="Go back" onclick="history.back()">
                <br>
                <br>
                <p><i>*All fields must be filled out!</i></p>
                <br> 
                
            </form>
            <br> 
            <br>
        </div>
    </body>
</html>