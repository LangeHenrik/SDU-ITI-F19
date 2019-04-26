<?php


// Auth
Route::get('/', 'AuthController@index');
Route::get('/auth/login', 'AuthController@login');
Route::post('/auth/login', 'AuthController@loginProcess');
Route::get('/auth/register', 'AuthController@register');
Route::post('/auth/register', 'AuthController@registerProcess');

// Feed
Route::get('/feed', 'FeedController@index');
Route::get('/feed/upload', 'FeedController@upload');
Route::post('/feed/upload', 'FeedController@uploadProcess');
Route::get('/feed/item/.*/like', 'FeedController@like');

// Users
Route::get('/users', 'UserController@index');

// Catch all
Route::get('.*', 'ErrorController@notFound');
Route::post('.*', 'ErrorController@notFound');