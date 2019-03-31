<?php

include('Route.php');

$db = new DatabaseManager();

Route::add('/welcome', function(){
    echo "Welcome";
});

//TODO: Add all the functions (Figure out if it should return views?)


Route::run('/');