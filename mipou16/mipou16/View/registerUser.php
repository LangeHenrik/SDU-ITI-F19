<html>
<head>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>


<form action="../Controllers/registerUserController.php" method="post">
    <div class="container">

        <label for="username"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" required>
        <br>
        <label for="password"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="password" id="password" pattern="^\S{6,}$"
               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
               required>
        <br>
        <label for="password"><b>Password</b></label>
        <br>
        <input type="password" placeholder="Confirm Password" name="password_two" id="password_two" pattern="^\S{6,}$"

               onchange="this.setCustomValidity(this.validity.patternMismatch ? ' enter the same Password as above' : '');"
               required>
        <br>
        <label for="FirstName"><b>First Name</b></label>
        <br>
        <input type="text" placeholder="Enter First name" name="firstname" required>
        <br>
        <label for="lastName"><b>Last Name</b></label>
        <br>
        <input type="text" placeholder="Enter Last name" name="lastname" required>
        <br>
        <label for="zip"><b>Zip Code</b></label>
        <br>
        <input type="text" placeholder="Enter Zip" name="zip" required>
        <br>
        <label for="city"><b>City</b></label>
        <br>
        <input type="text" placeholder="Enter City" name="city" required>
        <br>
        <label for="email"><b>Email</b></label>
        <br>
        <input type="email" placeholder="Enter Email" name="email" required>
        <br>
        <label for="phone"><b>Phone</b></label>
        <br>
        <input type="text" placeholder="Enter Phone" name="phone" required>
        <br>

        <button type="submit" value="Submit">Register</button>


    </div>
</form>


</body>


</html>