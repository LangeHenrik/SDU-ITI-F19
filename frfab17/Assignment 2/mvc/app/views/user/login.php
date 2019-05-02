<form method="POST" action="/frfab17/mvc/public/user/login">
    <label>username</label>
    <br/>
    <input type="text" name="username" id="username" />
    <br/>


    <label>password</label>
    <br/>
    <input type="password" name="password" id="password" />
    <br/>
    <br/>
    <button type="submit">Login</button>
</form>

<p style="font-size: larger">Don't have a user, then sign up.</p>

<form method="post" action="/frfab17/mvc/public/user/register">
    <input name="fullname" placeholder="Fullname" type="text" id="registerFields"><br>
    <input name="username" placeholder="Username" type="text" id="registerFields"><br>
    <input name="password" placeholder="Password" type="password" id="registerFields"><br>
    <input name="newpass" placeholder="Re-enter password" type="password" id="registerFields"><br>
    <div id="registerBtn">
        <input id="signupBtn" type="submit" value="Sign up">
    </div>
</form>