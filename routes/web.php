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
Route::match(['get', 'post'], 'forgot-password', ['as' => 'forgot-password', 'uses' => 'LoginController@forgotpassword']);
Route::match(['get', 'post'], 'change-password', ['as' => 'change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);

$userPrefix = "";
	Route::group(['prefix' => $userPrefix, 'middleware' => ['auth']], function() {
	Route::match(['get', 'post'], 'dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);
});

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
	Route::match(['get', 'post'], 'admin-dashboard', ['as' => 'admin-dashboard', 'uses' => 'Admin\AdminController@dashboard']);
    Route::match(['get', 'post'], 'list-demo', ['as' => 'list-demo', 'uses' => 'Admin\DemoController@index']);
    Route::match(['get', 'post'], 'demo-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\DemoController@ajaxAction']);
    Route::match(['get', 'post'], 'add-demo', ['as' => 'add-demo', 'uses' => 'Admin\DemoController@add']);
    Route::match(['get', 'post'], 'edit-demo/{id}', ['as' => 'edit-demo', 'uses' => 'Admin\DemoController@edit']);
    Route::match(['get', 'post'], 'list-company', ['as' => 'list-company', 'uses' => 'Admin\ComapnyController@index']);
    Route::match(['get', 'post'], 'add-company', ['as' => 'add-company', 'uses' => 'Admin\ComapnyController@addNewCompany']);
    Route::match(['get', 'post'], 'company-ajaxAction', ['as' => 'company-ajaxAction', 'uses' => 'Admin\ComapnyController@ajaxAction']);
    Route::match(['get', 'post'], 'edit-company/{id}', ['as' => 'edit-company', 'uses' => 'Admin\ComapnyController@edit']);
    Route::match(['get', 'post'], 'delete-company', ['as' => 'delete-company', 'uses' => 'Admin\ComapnyController@deleteCompany']);

});
