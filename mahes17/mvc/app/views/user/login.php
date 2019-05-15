<form method="POST" action="/mahes17/mvc/public/user/login">
    <label>Username</label>
    <br />
    <input type="text" name="username" id="username" />
    <br />

    <label>Password</label>
    <br />
    <input type="password" name="password" id="password" />
    <br />
    <br />
    <button type="submit">Login</button>
</form>
<p style="font-size: larger">Are you even in the system?</p>

<form method="post" action="/mahes17/mvc/public/user/signup">
    <input name="username" placeholder="Username" type="text" id="registerFields"><br>
    <input name="password" placeholder="Password" type="password" id="registerFields"><br>
    <input name="passwordRepeat" placeholder="Repeat password" type="password" id="registerFields"><br>
    <input name="firstName" placeholder="First name" type="text" id="registerFields"><br>
    <input name="lastName" placeholder="Last name" type="text" id="registerFields"><br>
    <input name="zip" placeholder="Zip code" type="text" id="registerFields"><br>
    <input name="city" placeholder="City" type="text" id="registerFields"><br>
    <input name="email" placeholder="E-mail address" type="text" id="registerFields"><br>
    <input name="phoneNumber" placeholder="Phone number" type="text" id="registerFields"><br>
    <input type="radio" checked> VIP Member<br> <!-- FYI Doesnt do anything  !-->
    <div id="registerBtn">
        <input id="signupBtn" type="submit" value="Register!!">
    </div>
</form>
