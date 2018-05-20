<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta de Landing Page.
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Login de usuario.
Route::get('user/login', [
    'as' => 'user.login',
    'uses' => 'Auth\UserLoginController@showLoginForm'
]);
Route::post('user/login', [
    'as' => '',
    'uses' => 'Auth\UserLoginController@login'
]);
Route::post('user/logout', [
    'as' => 'user.logout',
    'uses' => 'Auth\UserLoginController@logout'
]);

// Rutas de registro de usuario, bloqueadas por el guard de division.
Route::get('user/register', [
    'as' => 'user.register',
    'uses' => 'Auth\UserRegisterController@showRegistrationForm'
]);
Route::post('user/register', [
    'as' => '',
    'uses' => 'Auth\UserRegisterController@create'
]);

Route::get('user','UserController@index')->name('user.dashboard');


// Login Division:
Route::get('division/login', 'Auth\DivisionLoginController@showLoginForm')->name('division.login');
Route::post('division/login', 'Auth\DivisionLoginController@login')->name('division.login.submit');

// Registro de Division.
Route::get('division/register', 'Auth\DivisionRegisterController@showRegistrationForm')->name('division.register');
Route::post('division/register', 'Auth\DivisionRegisterController@create')->name('division.register.submit');

// Dashboard de Division.
Route::get('division', 'DivisionController@index')->name('division.dashboard');

// Lista de Usuarios.
Route::get('division/userslist', 'UsersListController@index')->name('division.usersList');

// Informacion especifica de cada usuario.
Route::get('division/userslist/{user}', 'UserInfoController@index')->name('division.userInfo');
Route::delete('division/userslist/{id}', 'UserInfoController@delete')->name('division.userInfo.delete');
Route::patch('division/userslist/{id}', 'UserInfoController@update')->name('division.userInfo.update');

// Creacion de Numeros
Route::get('division/userslist/{user}/number', 'NumberController@showNumberForm')->name('division.number');
Route::post('division/userslist/{user}/number', 'NumberController@create')->name('division.number.submit');
