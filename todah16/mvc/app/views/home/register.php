<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Dankify</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
  <!--Linked to CSS file -->    
    <link rel="stylesheet" type="text/css" href="../CSS/loggedIn.css"/>
    
</head>

<!--DOCTYPE_HTML-->
<html>
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file-->    
<link rel="stylesheet" type="text/css" href="CSS/Dankify_register.css"/>



<!--PHP code for including navigation bar -->    
<?php
 include '../app/views/partials/header.php';
?>

<style>
    
#register_submit {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

#register_submit:hover {
   background-color:lightgreen;
}
    
</style>
 
    
</head>    
    
<body>
<!-- action = "includes/register.inc.php" -->
    <main>
        <form name="registration" action="/todah16/mvc/public/service/register" onsubmit="return validateForm()" method="post">
        
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" id="uname">
            
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw">
            
            <label for="psw_repeat"><b>Repeat password</b></label>
            <input type="password" placeholder="Enter Password Again"   id="psw_repeat">
            
            <label for="fname"><b>First name</b></label>
            <input type="text" placeholder="Enter first name" name="fname" id="fname">
            
            <label for="lname"><b>Last name</b></label>
            <input type="text" placeholder="Enter last name" name="lname" id="lname">
            
            <label for="zip"><b>Zip code</b></label>
            <input type="text" placeholder="Enter Zipcode" name="zip" id="zip">
            
            <label for="city"><b>City</b></label>
            <input type="text" placeholder="Enter City" name="city" id="city">
            
            <label for="e-mail"><b>E-mail</b></label>
            <input type="text" placeholder="Enter E-mail" name="e-mail" id="e-mail">
            
            <label for="phone_number"><b>Phonenumber</b></label>
            <input type="text" placeholder="Enter Phonenumber" name="phone_number" id="phone_number">
            
            
            <input type="submit" name="register-submit" id="register_submit">
            <div id ="errors" class = "error">
                
            </div>
            
            
            </div>
            
        <div id="unamemsg" style="color:Red;display:none">Not a valid name</div>    
            
            
        </form> 
            
    </main>    

    
    <script>
        
        
private function validateForm() {
  
  var user_name = document.getElementById("uname").value;
  var password = document.getElementById("psw").value;
  var password_repeat = document.getElementById("psw_repeat").value;
  var first_name = document.getElementById("fname").value;
  var last_name = document.getElementById("lname").value;    
  var zip = document.getElementById("zip").value;
  var city = document.getElementById("city").value;
  var email = document.getElementById("e-mail").value;
  var phone_number = document.getElementById("phone_number").value;     
   
   //Regex object made that tests the username to ensure that the string is a word with no whitespace.
   var user_regex = /[^ ]$/;
   var user_name_test = user_regex.test(user_name);
    if(!user_name_test) {
        document.getElementById("uname").style.border = "1px solid red";
        return false;
        
    } 
    
    document.getElementById("uname").style.border = "1px solid #ccc";
    
    //Regex made that matches the password string with a string with a one lowercase, one uppercase, one numeric digit as well as a string with betweeen 6 & 20 characters.
    var password_regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    var password_test = password_regex.test(password);
    if(!password_test){
        
        document.getElementById("psw").style.border = "1px solid red";
        document.getElementById("errors").innerHTML = "Please write a password between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter";
        return false;
    } 
    
    document.getElementById("psw").style.border = "1px solid #ccc";
     
    
    if(!password_repeat.match(password)){    
        document.getElementById("psw_repeat").style.border = "1px solid red";
        document.getElementById("errors").innerHTML ="Please repeat the password above";
        return false;
        
    }
        document.getElementById("psw_repeat").style.border = "1px solid #ccc";
    
    //Regex object made that tests the name (both first and last) to ensure that the string is a word with no whitespace. 

    //First name
    var first_name_regex = /[^ ]$/;
    var first_name_test = first_name_regex.test(first_name);
    if(!first_name_test){
        document.getElementById("fname").style.border = "1px solid red";
        return false;
    }
    document.getElementById("fname").style.border = "1px solid #ccc";
    
    //Last name
    var last_name_regex = /[^ ]$/;
    var last_name_test = last_name_regex.test(last_name);
    if(!last_name_test){
        document.getElementById("lname").style.border = "1px solid red";
        return false;
    }
    document.getElementById("lname").style.border = "1px solid #ccc";
    
    
    //ZIP code - the regex object for the zip code is intended for the code to only contain 4 digits.
    var zip_regex = /^([0-9]{4})$/;
    var zip_test = zip_regex.test(zip);
    if(!zip_test){
        document.getElementById("zip").style.border = "1px solid red";
        document.getElementById("errors").innerHTML = "The zip code should contain exactly 4 digits.";
        return false;
    }
    document.getElementById("zip").style.border = "1px solid #ccc";
   
    //City - the city has to contain words only. 
    var city_regex = /[A-z]$/;
    var city_test = city_regex.test(city);
    if(!city_test){
        document.getElementById("city").style.border = "1px solid red";
        document.getElementById("errors").innerHTML = "The city name should contain no digits."
        return false;
    }
    document.getElementById("city").style.border = "1px solid #ccc"; 
    
    //Email - with a Regex object taken from stack overflow. The following regular expression is made to match 99.99% of all email addresses in use today using RFC 2822.
    var email_regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    var email_test = email_regex.test(email);
    if(!email_test){
        document.getElementById("e-mail").style.border = "1px solid red";
        document.getElementById("errors").innerHTML = "Please write your email in the following format xxxx@xxxxx.xxx";
        return false;
    }
    document.getElementById("e-mail").style.border = "1px solid #ccc";
    
    
    //Phone number - with a Regex object that states that the phone number should be written in the following format; +XXXXXXXX.
    var phone_number_regex = /[\d]{4}[\d]{4}$/;
    var phone_number_test = phone_number_regex.test(phone_number);
    if(!phone_number_test){
        document.getElementById("phone_number").style.border = "1px solid red";
        document.getElementById("errors").innerHTML = "Please write a phone number in the following format XXXXXXXX";
        return false;
    }
    document.getElementById("phone_number").style.border = "1px solid #ccc";
   
    
    
    
}
        
    
    </script>
    
    
</body>