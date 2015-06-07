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

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

Route::get('/', ['as' => 'home', 'uses' => 'BoardController@index']);
Route::post('/', ['uses' => 'BoardController@addBoard']);

Route::get('/board/{id}', ['as' => 'boardDetail', 'uses' => 'BoardController@boardDetail']);
Route::post('/board/{id}/delete', 'BoardController@deleteBoard');
Route::post('/board/{id}/update', 'BoardController@editBoard');

Route::post('/collaborator', ['uses' => 'BoardController@addCollaborator']);
Route::post('/collaborator/leave', ['uses' => 'BoardController@leaveCollaborator']);

Route::post('/card', ['as' => 'card', 'uses' => 'CardController@addCard']);
Route::post('/card/{id}/delete', 'CardController@deleteCard');

Route::post('/todo', ['as' => 'todo', 'uses' => 'TodoController@addTodo']);
Route::post('/todo/{id}', ['uses' => 'TodoController@toggleTodo']);
Route::post('/todo/{id}/delete', 'TodoController@deleteTodo');

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@index']);
Route::post('login', 'AuthController@login');

Route::get('/signup', ['as' => 'signup', 'uses' => 'SignupController@index']);
Route::post('signup', 'SignupController@signup');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::route('login');
});
