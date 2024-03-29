<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Account Registration</title>
    <link href="/mifor16/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">
    <script src = "/mifor16/mvc/public/js/registervalidation.js"></script>
</head>

<body>
<form action="/mifor16/mvc/public/Register/register" onsubmit="return validateForm()" method="post">
    <div class="box">

        <label for="username"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" id="username" required>

        <label for="password"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="password" id="password" pattern="^\S{6,}$"
               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must be at least 6 characters long.' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
               required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Confirm Password" name="password_two" id="password_two" pattern="^\S{6,}$"
               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Passwords not identical.' : '');"
               required>

        <label for="FirstName"><b>First Name</b></label>
        <input type="text" placeholder="Enter First name" name="firstname" id="firstname" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last name" name="lastname" id="lastname" required>

        <label for="zip"><b>Zip Code</b></label>
        <input type="text" placeholder="Enter Zip" name="zip" id="zip" required>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter City" name="city" id="city" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="mail" id="mail" required>

        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" id="phone" required>


        <button type="submit" value="Submit">Complete Registration</button>


    </div>
</form>

</body>

</html>
