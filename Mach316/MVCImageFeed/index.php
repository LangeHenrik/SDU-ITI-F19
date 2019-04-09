<?php

include('controllers/Route.php');
include('model/daos/DatabaseManager.php');

$db = new DatabaseManager();

Route::add('/', function(){
    include "views/feed.php";
});

Route::add('/login', function(){

    include "views/login.php";
});

Route::add('/loggedin' ,function(){
    include "views/loggedin.php";
});



Route::add('/users/([0-9]*)', function($userid) {
    echo "userid: ". $userid;
});

Route::add('/users', function() {
    include 'views/users.php';
});

Route::add('/feed', function() {
   include 'views/feed.php';
});


// Simple test route that simulates static html file
Route::add('/test.html',function(){
    echo 'Hello from test.html';
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

//TODO: Add all the functions (Figure out if it should return views?)


Route::run('/');