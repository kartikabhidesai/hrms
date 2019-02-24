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


$employeePrefix = "employee";
Route::group(['prefix' => $employeePrefix, 'middleware' => ['employee']], function() {
	Route::match(['get', 'post'], 'employee-dashboard', ['as' => 'employee-dashboard', 'uses' => 'Employee\DashboardController@dashboard']);
	Route::match(['get', 'post'], 'employee-leave', ['as' => 'employee-leave', 'uses' => 'Employee\LeaveController@index']);
    Route::match(['get', 'post'], 'add-leave', ['as' => 'add-leave', 'uses' => 'Employee\LeaveController@leaveadd']);
	Route::match(['get', 'post'], 'edit-leave/{id}', ['as' => 'edit-leave', 'uses' => 'Employee\LeaveController@leaveedit']);
    Route::match(['get', 'post'], 'employee-ajaxAction', ['as' => 'employee-ajaxAction', 'uses' => 'Employee\LeaveController@ajaxAction']);
    Route::match(['get', 'post'], 'payroll-employee', ['as' => 'payroll-employee', 'uses' => 'Employee\PayrollController@payrollEmpList']);


    Route::get('manage-time-change-request', ['as' => 'manage-time-change-request', 'uses' => 'Employee\ManageTimeChangeRequestController@manageTimeChangeRequestList']);
    Route::match(['get', 'post'], 'new-time-change-request', ['as' => 'new-time-change-request', 'uses' => 'Employee\ManageTimeChangeRequestController@newTimeChangeRequest']);
    Route::match(['get', 'post'], 'requestlist-ajaxAction', ['as' => 'requestlist-ajaxAction', 'uses' => 'Employee\ManageTimeChangeRequestController@ajaxAction']);    
    
    //edit-advance-salary-request
    Route::match(['get', 'post'], 'advance-salary-request', ['as' => 'advance-salary-request', 'uses' => 'Employee\AdvanceSalaryRequestController@requestList']);    
    Route::match(['get', 'post'], 'new-advance-salary-request', ['as' => 'new-advance-salary-request', 'uses' => 'Employee\AdvanceSalaryRequestController@newRequest']);    
    Route::match(['get', 'post'], 'advance-salary-request-ajaxAction', ['as' => 'advance-salary-request-ajaxAction', 'uses' => 'Employee\AdvanceSalaryRequestController@ajaxAction']);    
    Route::match(['get', 'post'], 'edit-advance-salary-request/{id}', ['as' => 'edit-advance-salary-request', 'uses' => 'Employee\AdvanceSalaryRequestController@editRequest']);

    /*Communication routes*/
    Route::match(['get', 'post'], 'emp-communication', ['as' => 'emp-communication', 'uses' => 'Employee\CommunicationController@communication']);    
    Route::match(['get', 'post'], 'emp-compose', ['as' => 'emp-compose', 'uses' => 'Employee\CommunicationController@compose']);   
    Route::match(['get', 'post'], 'emp-communication-detail/{id}', ['as' => 'emp-communication-detail/{id}', 'uses' => 'Employee\CommunicationController@empCommunicationDetail']);
    Route::match(['get', 'post'], 'empdownload-attachment/{file_name}', ['as' => 'empdownload-attachment/{file_name}', 'uses' => 'Employee\CommunicationController@downloadAttachment']);   
});
