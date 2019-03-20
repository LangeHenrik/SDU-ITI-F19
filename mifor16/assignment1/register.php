<?php
error_reporting(E_ALL);
session_start();
require 'dbmanager.php';
?>

<html>

<head>
    <title>Account Registration</title>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">
</head>

<body>
<form action="" method="post">
    <div class="box">

        <label for="username"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="password" id="password" pattern="^\S{6,}$"
               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
               required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Confirm Password" name="password_two" id="password_two" pattern="^\S{6,}$"
               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"
               required>

        <label for="FirstName"><b>First Name</b></label>
        <input type="text" placeholder="Enter First name" name="firstname" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last name" name="lastname" required>

        <label for="zip"><b>Zip Code</b></label>
        <input type="text" placeholder="Enter Zip" name="zip" required>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter City" name="city" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" required>


        <button type="submit" value="Submit">Complete Registration</button>


    </div>
</form>

</body>

</html>
