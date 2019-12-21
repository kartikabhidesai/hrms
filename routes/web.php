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
Route::get('clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode1 = Artisan::call('route:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode3 = Artisan::call('view:clear');
    return '<h1>cache route config view cleared</h1>';
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

Route::get('/login', function () {
    return Redirect::to('login');
});

Route::get('/','FrontendController@index');

Route::get('/social-media/{account}','TokenController@tokenCall');
Route::get('/facebook-user-profile','FacebookController@facebookUser');
Route::match(['get', 'post'], '/facebook/callback', ['as' => 'facebook', 'uses' => 'TokenController@facebook']);

Route::match(['get', 'post'], '/twitter/callback', ['as' => 'twitter', 'uses' => 'TokenController@twitter']);

Route::get('/facebook/share','TokenController@fbShare');
Route::get('/twitter/share','TokenController@twShare');



Route::match(['get', 'post'], 'exportxls', ['as' => 'exportxls', 'uses' => 'ExcelController@exportxls']);
Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'createpassword', ['as' => 'createpassword', 'uses' => 'LoginController@createpassword']);
Route::match(['get', 'post'], 'testingmail', ['as' => 'testingmail', 'uses' => 'LoginController@testingmail']);
Route::match(['get', 'post'], 'order', ['as' => 'order', 'uses' => 'OrderController@index']);
Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
Route::match(['get', 'post'], 'forgot-password', ['as' => 'forgot-password', 'uses' => 'LoginController@forgotpassword']);
Route::match(['get', 'post'], 'change-password', ['as' => 'change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);
Route::match(['get', 'post'], 'send-mail', ['as' => 'send-mail', 'uses' => 'Admin\SendmailController@sendmail']);

Route::match(['get', 'post'], 'zero-notification-count', ['as' => 'zero-notification-count', 'uses' => 'LoginController@zeroNotificationCount']);

Route::match(['get', 'post'], 'taskExpired', ['as' => 'taskExpired', 'uses' => 'CronController@taskExpired']);
Route::match(['get', 'post'], 'ticketExpired', ['as' => 'ticketExpired', 'uses' => 'CronController@ticketExpired']);
Route::match(['get', 'post'], 'recruitment-expire', ['as' => 'recruitment-expire', 'uses' => 'CronController@recruitmentSubmissionExpiry']);


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

    Route::match(['get', 'post'], 'payment-list', ['as' => 'payment-list', 'uses' => 'Admin\PaymentController@index']);
    Route::match(['get', 'post'], 'payment-ajaxAction', ['as' => 'payment-ajaxAction', 'uses' => 'Admin\PaymentController@ajaxAction']); 

    /*plan management*/
    Route::match(['get','post'],'plan-management',['as' => 'plan-management','uses'=>'Admin\PlanManagementController@index']);
    Route::match(['get','post'],'add-plan',['as' => 'add-plan','uses'=>'Admin\PlanManagementController@createPlan']);
    Route::match(['get','post'],'plan_management-edit/{id}',['uses'=>'Admin\PlanManagementController@editPlan']);
    Route::match(['get', 'post'], 'plan-management-ajaxAction', ['uses' => 'Admin\PlanManagementController@ajaxAction']); 
    
    /* Role management */
    Route::match(['get','post'],'add-role',['as' => 'add-role','uses'=>'Admin\RoleController@add']);
    Route::match(['get','post'],'edit-role/{id}',['as' => 'edit-role','uses'=>'Admin\RoleController@edit']);
    Route::match(['get','post'],'role-list',['as' => 'role-list','uses'=>'Admin\RoleController@index']);
    Route::match(['get', 'post'], 'role-ajaxAction', ['as' => 'role-ajaxAction', 'uses' => 'Admin\RoleController@ajaxAction']); 

    /* Send SMS/messages to admin */
    Route::match(['get', 'post'], 'sendSMS-ajaxAction', ['uses' => 'Admin\SendSMSController@ajaxAction']);
    Route::match(['get', 'post'], 'sms-list', ['uses' => 'Admin\SendSMSController@smsList']);
    Route::match(['get', 'post'], 'new-sms', ['uses' => 'Admin\SendSMSController@newSMS']);

    /* Communication Routes */
    Route::match(['get', 'post'], 'communication', ['uses' => 'Admin\CommunicationController@communication']);
    Route::match(['get', 'post'], 'compose', ['as' => 'admin-compose','uses' => 'Admin\CommunicationController@compose']);
    Route::match(['get', 'post'], 'mail-detail/{id}', ['uses' => 'Admin\CommunicationController@mailDetail']);
    Route::match(['get', 'post'], 'send-mail-detail/{id}', ['uses' => 'Admin\CommunicationController@sendMailDetail']);
    Route::match(['get', 'post'], 'download-attachment/{file_name}',['uses'=>'Admin\CommunicationController@downloadAttachment']);
    Route::match(['get', 'post'], 'send-mail', ['uses' => 'Admin\CommunicationController@sendMail']);
    
//    social Medoia Managment
    Route::match(['get', 'post'], 'social-media', ['uses' => 'Admin\SocialMediaController@index']);
    Route::match(['get', 'post'], 'manage-account', ['as' => 'manage-account','uses' => 'Admin\SocialMediaController@manageAccount']);
    Route::match(['get', 'post'], 'new-post', ['as' => 'new-post','uses' => 'Admin\SocialMediaController@newPost']);
    Route::match(['get', 'post'], 'socialMedia-ajaxAction', ['uses' => 'Admin\SocialMediaController@ajaxAction']);
    
    Route::match(['get', 'post'], 'admin-notification', ['as' => 'admin-notification', 'uses' => 'Admin\NotificationController@index']);
    Route::match(['get', 'post'], 'notification-ajaxAction', ['as' => 'notification-ajaxAction', 'uses' => 'Admin\NotificationController@ajaxAction']);
//    Route::match(['get', 'post'], 'admin-notification', ['uses' => 'Admin\SocialMediaController@ajaxAction']);

    // Report Routes
    Route::match(['get', 'post'], 'admin-report-list', ['as' => 'admin-report-list', 'uses' => 'Admin\ReportController@index']);
    Route::match(['get', 'post'], 'admin-task-report', ['as' => 'admin-task-report', 'uses' => 'Admin\TaskReportController@index']);
    Route::match(['get', 'post'], 'company-report', ['as' => 'company-report', 'uses' => 'Admin\CompanyReportController@index']);
    Route::match(['get', 'post'], 'company-report-ajaxAction', ['as' => 'company-report-ajaxAction', 'uses' => 'Admin\CompanyReportController@ajaxAction']);
    Route::match(['get', 'post'], 'finance-report', ['as' => 'finance-report', 'uses' => 'Admin\FinanceReportController@index']);
    Route::match(['get', 'post'], 'finance-report-ajaxAction', ['as' => 'finance-report-ajaxAction', 'uses' => 'Admin\FinanceReportController@ajaxAction']);
    Route::match(['get', 'post'], 'order-report', ['as' => 'order-report', 'uses' => 'Admin\OrderReportController@index']);
    Route::match(['get', 'post'], 'order-report-ajaxAction', ['as' => 'order-report-ajaxAction', 'uses' => 'Admin\OrderReportController@ajaxAction']);
    Route::match(['get', 'post'], 'plan-package-report', ['as' => 'plan-package-report', 'uses' => 'Admin\PlanAndPackageReportController@index']);
    Route::match(['get', 'post'], 'plan-package-report-ajaxAction', ['as' => 'plan-package-report-ajaxAction', 'uses' => 'Admin\PlanAndPackageReportController@ajaxAction']);

     // Chet
     Route::match(['get', 'post'], 'admin-chat', ['as' => 'admin-chat', 'uses' => 'Admin\ChatController@index']);
     Route::match(['get', 'post'], 'admin-chatnew/{id}', ['as' => 'admin-chatnew', 'uses' => 'Admin\ChatController@chatnew']);
     Route::match(['get', 'post'], 'chat-ajaxAction', ['as' => 'admin-chat-ajaxAction', 'uses' => 'Admin\ChatController@ajaxAction']);

     /* Calendar */
    Route::match(['get', 'post'], 'admin-calendar', ['as' => 'admin-calendar', 'uses' => 'Admin\CalendarController@index']);
    Route::match(['get', 'post'], 'admin-calendar-ajaxAction', ['as' => 'admin-calendar-ajaxAction', 'uses' => 'Admin\CalendarController@ajaxAction']);
    Route::match(['get', 'post'], 'admin-getevents', ['as' => 'admin-getevents', 'uses' => 'Admin\CalendarController@getEvent']);

});
