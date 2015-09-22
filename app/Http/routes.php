<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Restrict the pages to the authenticated users
// The filters.php file has been deprecated, now Laravel is using Middleware classes to control this behavior.
// Check Authenticate.php to see the redirection conditional
Route::get('/', array('as' => 'home', 'middleware' => 'auth', 'uses' => 'UserController@home'));




Route::get('/login', array('as' => 'login', 'uses' => 'UserController@getLogin'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@postLogin'));

Route::get('/register', array('as' => 'register', 'uses' => 'UserController@getRegister'));
Route::post('/register', array('as' => 'register', 'uses' => 'UserController@postRegister'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));