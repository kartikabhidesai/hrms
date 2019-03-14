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
    Route::match(['get', 'post'], 'payslip-ajaxAction', ['as' => 'payslip-ajaxAction', 'uses' => 'Company\PayslipController@ajaxAction']);

    /*Send SMS/messages to employees*/
    Route::match(['get', 'post'], 'sendSMS-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Company\SendSMSController@ajaxAction']);
    Route::match(['get', 'post'], 'sms-list', ['as' => 'sms-list', 'uses' => 'Company\SendSMSController@smsList']);
    Route::match(['get', 'post'], 'new-sms', ['as' => 'new-sms', 'uses' => 'Company\SendSMSController@newSMS']);

    /*Manage Time Change Request*/
    Route::match(['get', 'post'], 'time-change-request', ['as' => 'time-change-request', 'uses' => 'Company\ManageTimeChangeRequestController@timeChangeRequest']);
    Route::match(['get', 'post'], 'timeChangeRequest-ajaxAction', ['as' => 'timeChangeRequest-ajaxAction', 'uses' => 'Company\ManageTimeChangeRequestController@ajaxaction']);

    /*TIckets Routes*/
    Route::match(['get', 'post'], 'ticket-list', ['as' => 'ticket-list', 'uses' => 'Company\TicketController@index']);
    Route::match(['get', 'post'], 'add-ticket', ['as' => 'add-ticket', 'uses' => 'Company\TicketController@add']);
    Route::match(['get', 'post'], 'ticket-ajaxAction', ['as' => 'ticket-ajaxAction', 'uses' => 'Company\TicketController@ajaxaction']);
    Route::match(['get', 'post'], 'download-attachment/{file}', ['as' => 'download-attachment', 'uses' => 'Company\TicketController@downloadAttachment']);
    
    /*Manage Time Change Request*/
    Route::match(['get', 'post'], 'pay-slip', ['as' => 'pay-slip', 'uses' => 'Company\PayslipController@create']);
    Route::match(['get', 'post'], 'create-pdf', ['as' => 'create-pdf', 'uses' => 'Company\PayslipController@createPDF']);

    //campany-advance-salary-request//advance-salary-request-ajaxAction
    Route::match(['get', 'post'], 'campany-advance-salary-request', ['as' => 'campany-advance-salary-request', 'uses' => 'Company\AdvanceSalaryRequestController@requestList']);
    Route::match(['get', 'post'], 'approved-advance-salary-request', ['as' => 'approved-advance-salary-request', 'uses' => 'Company\AdvanceSalaryRequestController@approvedRequestList']);
    Route::match(['get', 'post'], 'advance-salary-request-ajaxAction', ['as' => 'advance-salary-request-ajaxAction', 'uses' => 'Company\AdvanceSalaryRequestController@ajaxaction']);
    Route::match(['get', 'post'], 'approved-salary-request-ajaxAction', ['as' => 'approved-salary-request-ajaxAction', 'uses' => 'Company\AdvanceSalaryRequestController@approvedListAjaxaction']);
    Route::match(['get', 'post'], 'createApprovedPdf', ['as' => 'createApprovedPdf', 'uses' => 'Company\AdvanceSalaryRequestController@createApprovedPdf']);
    Route::match(['get', 'post'], 'downloadApprovedPdf', ['as' => 'downloadApprovedPdf', 'uses' => 'Company\AdvanceSalaryRequestController@downloadApprovedPdf']);
    Route::match(['get', 'post'], 'add-advance-salary-request', ['as' => 'add-advance-salary-request', 'uses' => 'Company\AdvanceSalaryRequestController@newRequest']);
        
    // Communication task-list
        
    Route::match(['get', 'post'], 'communication', ['as' => 'communication', 'uses' => 'Company\CommunicationController@communication']);
    Route::match(['get', 'post'], 'compose', ['as' => 'compose', 'uses' => 'Company\CommunicationController@compose']);
    Route::match(['get', 'post'], 'mail-detail/{id}', ['as' => 'mail-detail/{id}', 'uses' => 'Company\CommunicationController@mailDetail']);
    Route::match(['get', 'post'], 'download-attachment/{file_name}', ['as' => 'download-attachment/{file_name}', 'uses' => 'Company\CommunicationController@downloadAttachment']);
    Route::match(['get', 'post'], 'send-mail', ['as' => 'send-mail', 'uses' => 'Company\CommunicationController@sendMail']);

//    task-list
    Route::match(['get', 'post'], 'task-list', ['as' => 'task-list', 'uses' => 'Company\TaskController@index']);
    Route::match(['get', 'post'], 'task-ajaxAction', ['as' => 'task-ajaxAction', 'uses' => 'Company\TaskController@ajaxAction']);
    Route::match(['get', 'post'], 'add-task', ['as' => 'add-task', 'uses' => 'Company\TaskController@addTask']);

    Route::match(['get', 'post'], 'sent-notification', ['as' => 'sent-notification', 'uses' => 'Company\NotificationController@sentNotification']);
    Route::match(['get', 'post'], 'notification-list', ['as' => 'notification-list', 'uses' => 'Company\NotificationController@notificationList']);

    /*Calendar*/
    Route::match(['get', 'post'], 'calendar', ['as' => 'calendar', 'uses' => 'Company\CalendarController@index']);
    Route::match(['get', 'post'], 'calendar-ajaxAction', ['as' => 'calendar-ajaxAction', 'uses' => 'Company\CalendarController@ajaxAction']);
    Route::match(['get', 'post'], 'getevents', ['as' => 'getevents', 'uses' => 'Company\CalendarController@getEvent']);

    /*Performance*/
    Route::match(['get', 'post'], 'performance', ['as' => 'performance', 'uses' => 'Company\PerformanceController@index']);
    Route::match(['get', 'post'], 'addperformance', ['as' => 'addperformance', 'uses' => 'Company\PerformanceController@addPerformance']);
    Route::match(['get', 'post'], 'employee-performance-list/{id}', ['as' => 'employee-performance-list', 'uses' => 'Company\PerformanceController@employeePerList']);
    Route::match(['get', 'post'], 'performance-emp-detail/{id}', ['as' => 'performance-emp-detail', 'uses' => 'Company\PerformanceController@performanceEmpList']);

    /*Training*/
    Route::match(['get', 'post'], 'training', ['as' => 'training', 'uses' => 'Company\TrainingController@index']);
    Route::match(['get', 'post'], 'add-training', ['as' => 'add-training', 'uses' => 'Company\TrainingController@addTraining']);
    Route::match(['get', 'post'], 'training-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Company\TrainingController@ajaxAction']);

    /*System-setting*/
    Route::match(['get', 'post'], 'system-setting', ['as' => 'system-setting', 'uses' => 'Company\SystemsettingController@index']);
    
    /*Recruitement*/

    Route::match(['get', 'post'], 'recruitment', ['as' => 'recruitment', 'uses' => 'Company\RecruitmentController@index']);
    Route::match(['get', 'post'], 'recruitment-add', ['as' => 'recruitment-add', 'uses' => 'Company\RecruitmentController@addRecruitment']);
    Route::match(['get', 'post'], 'recruitment-ajaxAction', ['as' => 'recruitment-ajaxAction', 'uses' => 'Company\RecruitmentController@ajaxAction']);
    Route::match(['get', 'post'], 'recruitment-edit/{id}', ['as' => 'recruitment-edit', 'uses' => 'Company\RecruitmentController@editRecruitment']);
    
    /*Annoumcement*/
    Route::match(['get','post'],'announcement',['as'=>'announcement','uses'=>'Company\AnnouncementController@index']);
    Route::match(['get','post'],'announcement-add',['as'=>'announcement-add','uses'=>'Company\AnnouncementController@anounment_add']);
    
});