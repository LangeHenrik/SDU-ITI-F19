<head>
    <link rel="stylesheet" type="text/css" href="/mvc/public/css/style.css">
    <script src="/mvc/public/js/checkform.js"></script>
    <script src="/mvc/public/js/ajax.js"></script>
</head>
<h4 id="err"> <?= $viewbag['err'] ?? '' ?></h4>
<form onsubmit='return checkForm()' id='form' action='/mvc/public/home/auth/confirmsignup' method='POST'>
    <h1> Signup </h1>
    <input type='text' class='text' placeholder='Firstname' id='fname' name='fname'
           value='<?= $_POST['fname'] ?? '' ?>'>
    <input type='text' class='text' placeholder='Lastname' id='lname' name='lname' value='<?= $_POST['lname'] ?? '' ?>'>
    <input type='text' class='text' placeholder='ZIP code' id='zip' name='zip' value='<?= $_POST['zip'] ?? '' ?>'>
    <input type='text' class='text' placeholder='City' id='city' name='city' value='<?= $_POST['city'] ?? '' ?>'>
    <input type='text' class='text' placeholder='Phone' id='phone' name='phone' value='<?= $_POST['phone'] ?? '' ?>'>
    <input type='text' class='text' placeholder='Username' id='username' name='username'
           value='<?= $_POST['username'] ?? '' ?>'>
    <input type='text' class='text' placeholder='E-mail' id='mail' name='mail' value='<?= $_POST['mail'] ?? '' ?>'>
    <input id='password' type='password' class='text' placeholder='Password' name='password'>
    <input id='password2' type='password' class='text' placeholder='Repeat Password' name='password2'>
    <input type='submit' class='text' value='Opret Bruger' id='submit'>
</form>
<?php
