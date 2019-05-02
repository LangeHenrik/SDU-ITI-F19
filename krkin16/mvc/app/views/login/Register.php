<html>
    <head>
        <link rel="stylesheet" href="/krkin16/mvc/app/views/css/login_style.css">
        <meta name="viewport" content = "width=device-width, initial-scale=1.0">
        <script src="/krkin16/mvc/app/views/login/validate_registration.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class = 'register'>
            <h1>Register User</h1>
            <form method="post" onsubmit="validateForm(this)" id="registerForm" action="javascript:;">
                <div class="input">
                    <p>Username: </p><p id="login_wrong"></p>
                    <input type="text" name="login" value="" id="login" required>
                    <p>Password: </p><p id="password_wrong"></p>
                    <input type="password" name="password" value="" id="password" required">
                    <p>Confirm Password: </p><p id="password_confirm_wrong"></p>
                    <input type="password" name="password_confirm" value="" id="password_confirm" required>


                    <p>First Name: </p><p id="first_name_wrong"></p>
                    <input type="text" name="first_name" value="" id="first_name" required>
                    <p>Last Name: </p><p id="last_name_wrong"></p>
                    <input type="text" name="last_name" value=""id="last_name" required>
                    <p>Zip: </p><p id="zip_wrong"></p>
                    <input type="text" name="zip" value="" id="zip" required>
                    <p>City: </p><p id="city_wrong"></p>
                    <input type="text" name="city" value="" id="city" required>
                    <p>Email: </p><p id="email_wrong"></p>
                    <input type="text" name="email" value="" id="email" required>
                    <p>Phone: </p><p id="phone_wrong"></p>
                    <input type="text" name="phone" value="" id="phone" required>
                </div>
                <input type="submit" name="submit" value="Register!" id="register_button">
            </form>
        </div>
    </body>

</html>
