<?php include '../app/views/home/header.php'; ?>


<body>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<div id="frm">
    <form method="POST" action="/mvc/public/user/login" >
        <label>Username</label>
        <br/>
        <input type="text" name="username" id="username" />
        <br/>


        <label>Password</label>
        <br/>
        <input type="password" name="pass_1" id="pass_1" />
        <br/>
        <br/>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Log In">
        </div>
        <p>
            Not yet a member? <a href="register">Sign Up</a>
        </p>
    </form>
</div>
</body>
