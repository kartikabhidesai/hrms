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

    Route::match(['get', 'post'], 'payroll-list', ['as' => 'payroll-list', 'uses' => 'Company\PayrollController@list']); 
    Route::match(['get', 'post'], 'payroll-add', ['as' => 'payroll-add', 'uses' => 'Company\PayrollController@add']);  
    Route::match(['get', 'post'], 'payroll-edit', ['as' => 'payroll-edit', 'uses' => 'Company\PayrollController@list']);
    Route::match(['get', 'post'], 'payroll-emp-detail/{id}', ['as' => 'payroll-emp-detail', 'uses' => 'Company\PayrollController@payrollEmpList']);

});