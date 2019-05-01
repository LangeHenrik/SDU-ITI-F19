
<!DOCTYPE html>
<html lang="en">

<head>
  <meta <meta charset="UTF-8" />
  <title>Sign Up</title>

</head>
<style>
body{
    background-color:#f2f2f2;
}

h1{
  font-family: sans-serif;
  font-size: 32px;
  text-align: center;
  margin-top: 5%;
}
p,a{
  font-family: sans-serif;
}

.wrapper{
  /* padding: 50px 600px 20px 600px; */

 margin-left: 30%;
  /* margin-right: 30%; */ 
  width: 70%;

}

/* ------------Form---------- */
 .row input{
  width: 50%;
  padding: 12px;
  resize: vertical;

}
.row label{
  font-family: sans-serif;
  font-size: 16px;
  padding: 12px 12px 12px 0;
  display: inline-block;
}


.row::after{
  content: "";
  display: table;
  clear: both;
}

.col_1 {
  float: left;
  width: 25%;
  margin-top: 10px;
}
.col_2{
  float: left;
  width: 75%;
  margin-top: 10px;
}
.submit_button input{
  margin-left: 25%;
  margin-top: 10px;
  width: 40%;
}

</style>
<body> 
  <h1>Sign up here!</h1>
  <div class="wrapper">
    <p>Please fill up all the textfields.</p> <label><?=$_SERVER['register_msg']?></label>
    <form action="/peten17/mvc/public/home/register" method="post">
      <div class="row">
        <div class="col_1">
          <label>Username</label>
        </div>
        <div class="col_2">
          <input type="text" name="username" value="" />
        </div>
        <div class="row">
          <div class="col_1">
            <label>Password</label>
          </div>
          <div class="col_2">
            <input type="password" name="password" value="" />
         </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Confirm password</label>
          </div>
          <div class="col_2">
            <input type="password" name="confirm_password" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Firstname</label>
          </div>
          <div class="col_2">
            <input type="text" name="firstname" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Lastname</label>
          </div>
          <div class="col_2">
            <input type="text" name="lastname" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Zip-code</label>
          </div>
          <div class="col_2">
            <input type="text" name="zipcode" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>City</label>
          </div>
          <div class="col_2">
            <input type="text" name="city" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Email</label>
          </div>
          <div class="col_2">
            <input type="email" name="email" value="" />
          </div>
        </div>
        <div class="row">
          <div class="col_1">
            <label>Phone</label>
          </div>
          <div class="col_2">
            <input type="tel" name="phone" value="" />
          </div>
        </div>
        <div class="submit_button">
          <input type="submit" name="register" value="Sign up!" />
        </div>
        <p>I have an account already!
          <a href="../../../public/">Click here!</a></p>
    </form>
  </div>
</body>
