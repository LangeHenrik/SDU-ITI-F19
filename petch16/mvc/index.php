<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}
require_once('./app/core/Route.php');
//require_once('./PHP/Controller/ApiController.php');
Route::add('/',function(){
    include(__DIR__.'/app/View/index.php');
});
Route::add('/index',function(){
    include(__DIR__.'/app/View/index.php');
});

Route::add('/welcome',function(){
    include(__DIR__.'/app/View/welcome.php');
});

Route::add('/login',function(){
    include(__DIR__.'/app/View/login.php');
});

Route::add('/upload',function(){
    include(__DIR__.'/app/View/upload.php');
});

Route::add('/reset-password',function(){
    include(__DIR__.'/app/View/reset-password.php');
});
Route::add('/register',function(){
    include(__DIR__.'/app/View/register.php');
});

Route::add('/logout',function(){
    include(__DIR__.'/app/View/logout.php');
});

Route::run();