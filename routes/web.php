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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/', function () {
    return Redirect::to('login');
});

Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'order', ['as' => 'order', 'uses' => 'OrderController@index']);
Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
Route::match(['get', 'post'], 'forgot-password', ['as' => 'forgot-password', 'uses' => 'LoginController@forgotpassword']);
Route::match(['get', 'post'], 'change-password', ['as' => 'change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);
Route::match(['get', 'post'], 'send-mail', ['as' => 'send-mail', 'uses' => 'Admin\SendmailController@sendmail']);

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
    Route::match(['get', 'post'], 'send-mail', ['as' => 'send-mail', 'uses' => 'Admin\DemoController@sendMail']);
    Route::match(['get', 'post'], 'edit-demo/{id}', ['as' => 'edit-demo', 'uses' => 'Admin\DemoController@edit']);
    Route::match(['get', 'post'], 'list-company', ['as' => 'list-company', 'uses' => 'Admin\ComapnyController@index']);
    Route::match(['get', 'post'], 'add-company', ['as' => 'add-company', 'uses' => 'Admin\ComapnyController@addNewCompany']);
    Route::match(['get', 'post'], 'company-ajaxAction', ['as' => 'company-ajaxAction', 'uses' => 'Admin\ComapnyController@ajaxAction']);
    Route::match(['get', 'post'], 'edit-company/{id}', ['as' => 'edit-company', 'uses' => 'Admin\ComapnyController@edit']);
    Route::match(['get', 'post'], 'delete-company', ['as' => 'delete-company', 'uses' => 'Admin\ComapnyController@deleteCompany']);

     Route::match(['get', 'post'], 'list-cmspage', ['as' => 'list-cmspage', 'uses' => 'Admin\CmsPageController@index']);
    Route::match(['get', 'post'], 'cmspage-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\CmsPageController@ajaxAction']);
    Route::match(['get', 'post'], 'edit-cmspage/{id}', ['as' => 'edit-cmspage', 'uses' => 'Admin\CmsPageController@edit']);
    
    
    Route::match(['get', 'post'], 'setting', ['as' => 'setting', 'uses' => 'Admin\SettingController@index']);
    
    
    Route::match(['get', 'post'], 'list-email', ['as' => 'list-email', 'uses' => 'Admin\EmailController@index']);
    Route::match(['get', 'post'], 'add-email', ['as' => 'add-email', 'uses' => 'Admin\EmailController@addMail']);
    Route::match(['get', 'post'], 'edit-email/{id}', ['as' => 'edit-email', 'uses' => 'Admin\EmailController@editMail']);

     /* Set Tax */
    Route::match(['get', 'post'], 'set-tax', ['as' => 'set-tax', 'uses' => 'Admin\TaxController@setTax']); 
    
    /* Order  */
    Route::match(['get', 'post'], 'order-list', ['as' => 'order-list', 'uses' => 'Admin\OrderController@index']); 
    Route::match(['get', 'post'], 'order-approved-list', ['as' => 'order-approved-list', 'uses' => 'Admin\OrderController@approved_list']); 
    Route::match(['get', 'post'], 'order-ajaxAction', ['as' => 'order-ajaxAction', 'uses' => 'Admin\OrderController@ajaxAction']); 
});
