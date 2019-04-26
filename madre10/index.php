<?php
session_start();
// Include router class
require_once('./PHP/Controller/Route.php');
require_once('./PHP/Controller/ApiController.php');


Route::add('/',function(){
    include(__DIR__.'/PHP/View/index.php');
});

Route::add('/index',function(){
    include(__DIR__.'/PHP/View/index.php');
});

Route::add('/feed', function(){
    include(__DIR__.'/PHP/View/feed.php');
}, 'GET');

Route::add('/feed', function(){
    include(__DIR__.'/PHP/Controller/createComment.php');
}, 'POST');


Route::add('/me', function(){
    include(__DIR__.'/PHP/View/me.php');
});

Route::add('/users', function(){
    include(__DIR__.'/PHP/View/users.php');
});

Route::add('/images', function(){
    include(__DIR__.'/PHP/View/images.php');
});

Route::add('/ajax', function(){
    include(__DIR__.'/PHP/View/ajax.php');
});

Route::add('/login', function(){
    include(__DIR__.'/PHP/View/login.php');
});

Route::add('/login', function(){
    include(__DIR__.'/PHP/View/login.php');
}, 'post');

Route::add('/logout', function(){
    include(__DIR__.'/PHP/View/logout.php');
});

Route::add('/register', function(){
    include(__DIR__.'/PHP/View/register.php');
});

Route::add('/register', function(){
    include(__DIR__.'/PHP/View/register.php');
}, 'post');

Route::add('/upload', function(){
   include(__DIR__.'/PHP/Controller/uploadController.php');
}, 'POST');




Route::add('/madre10/mvc/public/api/users', function(){
   apiGetAllUsers();
});

Route::add('/madre10/mvc/public/api/pictures/user/([0-9]*)', function($var1){
    apiGetUserPictures($var1);
});

Route::add('/madre10/mvc/public/api/pictures/user/([0-9]*)', function($var1){
    apiPostPicture($var1);
}, 'POST');



// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/([0-9]*)/([0-9]*)',function($var1, $var2){
    echo $var1.' is a great number.. so is'.$var2;
});

// Post route example
Route::add('/contact-form',function(){
    echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
},'get');

// Post route example
Route::add('/contact-form',function(){
    echo 'Hey! The form has been sent:<br/>';
    print_r($_POST);
},'post');

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar',function($var1){
    echo $var1.' is a great number!';
});

Route::run();