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

$companyPrefix = "company";
Route::group(['prefix' => $companyPrefix, 'middleware' => ['company']], function() {
	Route::match(['get', 'post'], 'company-dashboard', ['as' => 'company-dashboard', 'uses' => 'Company\CompanyController@dashboard']);

    /*Employee related routes*/
    Route::match(['get', 'post'], 'employee-list', ['as' => 'employee-list', 'uses' => 'Company\EmployeeController@index']);
    Route::match(['get', 'post'], 'employee-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Company\EmployeeController@ajaxAction']);
    Route::match(['get', 'post'], 'employee-add', ['as' => 'employee-add', 'uses' => 'Company\EmployeeController@add']);
    Route::match(['get', 'post'], 'employee-edit/{id}', ['as' => 'employee-edit', 'uses' => 'Company\EmployeeController@edit']);
    
    /*Department related routes*/
    Route::match(['get', 'post'], 'department-list', ['as' => 'department-list', 'uses' => 'Company\DepartmentController@index']);
    Route::match(['get', 'post'], 'department-ajaxAction', ['as' => 'department-ajaxAction', 'uses' => 'Company\DepartmentController@ajaxAction']);
    Route::match(['get', 'post'], 'department-add', ['as' => 'department-add', 'uses' => 'Company\DepartmentController@add']);
    Route::match(['get', 'post'], 'department-edit/{id}', ['as' => 'department-edit', 'uses' => 'Company\DepartmentController@edit']);
    Route::match(['get', 'post'], 'delete-department', ['as' => 'delete-department', 'uses' => 'Company\DepartmentController@deleteDepartment']);

    /*Attendance related routes*/
    Route::match(['get', 'post'], 'daily-attendance', ['as' => 'daily-attendance', 'uses' => 'Company\AttendanceController@dailyAttendance']);
    // Route::match(['get', 'post'], 'daily-attendance_view', ['as' => 'daily-attendance_view', 'uses' => 'Company\AttendanceController@dailyAttendance']);
    Route::match(['get', 'post'], 'attendance-report', ['as' => 'attendance-report', 'uses' => 'Company\AttendanceController@attendanceReport']);
    Route::match(['get', 'post'], 'manage-attendance-history', ['as' => 'manage-attendance-history', 'uses' => 'Company\AttendanceController@manageAttendanceHistory']);
    Route::match(['get', 'post'], 'attendance-history-ajaxAction', ['as' => 'attendance-history-ajaxAction', 'uses' => 'Company\AttendanceController@ajaxAction']);

    /*Payroll related routes*/
    Route::match(['get', 'post'], 'payroll-list', ['as' => 'payroll-list', 'uses' => 'Company\PayrollController@index']); 
    Route::match(['get', 'post'], 'payroll-add/{id}', ['as' => 'payroll-add', 'uses' => 'Company\PayrollController@add']);  
    Route::match(['get', 'post'], 'payroll-edit/{id}', ['as' => 'payroll-edit', 'uses' => 'Company\PayrollController@edit']);
    Route::match(['get', 'post'], 'payroll-emp-detail/{id}', ['as' => 'payroll-emp-detail', 'uses' => 'Company\PayrollController@payrollEmpList']);
    Route::match(['get', 'post'], 'payroll-ajaxAction', ['as' => 'payroll-ajaxAction', 'uses' => 'Company\PayrollController@ajaxAction']);

    /*Send SMS/messages to employees*/
    Route::match(['get', 'post'], 'sendSMS-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Company\SendSMSController@ajaxAction']);
    Route::match(['get', 'post'], 'sms-list', ['as' => 'sms-list', 'uses' => 'Company\SendSMSController@smsList']);
    Route::match(['get', 'post'], 'new-sms', ['as' => 'new-sms', 'uses' => 'Company\SendSMSController@newSMS']);

    /*Manage Time Change Request*/
    Route::match(['get', 'post'], 'time-change-request', ['as' => 'time-change-request', 'uses' => 'Company\ManageTimeChangeRequestController@timeChangeRequest']);
    Route::match(['get', 'post'], 'timeChangeRequest-ajaxAction', ['as' => 'timeChangeRequest-ajaxAction', 'uses' => 'Company\ManageTimeChangeRequestController@ajaxaction']);
    
    /*Manage Time Change Request*/
    Route::match(['get', 'post'], 'pay-slip', ['as' => 'pay-slip', 'uses' => 'Company\PayslipController@create']);
    Route::match(['get', 'post'], 'create-pdf', ['as' => 'create-pdf', 'uses' => 'Company\PayslipController@createPDF']);

    //campany-advance-salary-request//advance-salary-request-ajaxAction
    Route::match(['get', 'post'], 'campany-advance-salary-request', ['as' => 'campany-advance-salary-request', 'uses' => 'Company\AdvanceSalaryRequestController@requestList']);
    Route::match(['get', 'post'], 'advance-salary-request-ajaxAction', ['as' => 'advance-salary-request-ajaxAction', 'uses' => 'Company\AdvanceSalaryRequestController@ajaxaction']);
});