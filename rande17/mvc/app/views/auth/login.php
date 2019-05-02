<head>
    <link rel="stylesheet" type="text/css" href="/mvc/public/css/style.css">
    <script src="/mvc/public/js/checkform.js"></script>
    <script src="/mvc/public/js/ajax.js"></script>
</head>
<form id='form' action='/mvc/public/home/auth/authtenticate' method='POST'>
    <h1> LOGIN </h1>
    <input type='text' class='text' placeholder='Username' name='username' value='<?= $viewbag['username'] ?? '' ?>'>
    <input type='password' class='text' placeholder='Password' name='password'>
    <input type='submit' class='text' value='Login &#8605;' id='submit'>
</form>
<a class='link' href='/mvc/public/home/auth/signup'>Opret bruger</a>

