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
    <form onsubmit="return checkFields()" method="POST" action="/mvc/public/user/register" >
        <label>Username:</label>
        <br/>
        <input type="text" name="username" />
        <br/>

        <label>Password:</label>
        <br/>
        <input type="password" name="pass_1"/>
        <br/>

        <label>Confirm Password:</label>
        <br/>
        <input type="password" name="pass_2"/>
        <br/>

        <label>First Name:</label>
        <br/>
        <input type="text" name="name_1" />
        <br/>

        <label>Last Name:</label>
        <br/>
        <input type="text" name="name_2"/>
        <br/>

        <label>Zip Code:</label>
        <br/>
        <input type="text" name="zip"/>
        <br/>

        <label>City:</label>
        <br/>
        <input type="text" name="city" />
        <br/>

        <label>Email:</label>
        <br/>
        <input type="text" name="email"/>
        <br/>

        <label>Phone Number:</label>
        <br/>
        <input type="text" name="ph_number"/>
        <br/>
        <input type="submit" class="btn btn-primary" value="Register">
    </form>
    <a href="../home/">
        <input type="submit" value="I already have an account""/>
    </a>

</div>
</body>
<script>
    function checkFields(){
        var password = document.getElementById("pass_1").value;
        var mail = document.getElementById("email").value;
        var ph = document.getElementById("ph_number").value;

        var passRegex = new RegExp("^(?=[^\\d_].*?\\d)\\w(\\w|[!@#$%]){7,20}");
        var mailRegEx = new RegExp("^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\\.)+(?:[a-zA-Z]{2}|aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel)$");
        var phRegex = new RegExp("\d{8}");
        if(passRegex.test(password)){
            if(mailRegEx.test(mail)){
                if(phRegex.test(ph)){
                    return true;
                }
            }
        } else{
            return false;
        }
    }
</script>