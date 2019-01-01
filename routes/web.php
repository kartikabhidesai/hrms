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

Route::get('/', function () {
    return Redirect::to('login');
});

Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
$userPrefix = "";
	Route::group(['prefix' => $userPrefix, 'middleware' => ['auth']], function() {
	Route::match(['get', 'post'], 'dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);
	
});

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
	Route::match(['get', 'post'], 'admin-dashboard', ['as' => 'admin-dashboard', 'uses' => 'Admin\AdminController@dashboard']);
	Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);
    Route::match(['get', 'post'], 'change-password', ['as' => 'change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
});

$clientPrefix = "client";
Route::group(['prefix' => $clientPrefix, 'middleware' => ['client']], function() {
	Route::match(['get', 'post'], 'client-dashboard', ['as' => 'client-dashboard', 'uses' => 'Client\ClientController@dashboard']);
});