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
    Route::match(['post'], 'employee-task-comment', ['uses' => 'Employee\DashboardController@employeeTaskComment']);
    Route::match(['post'], 'employee-upload-file', ['uses' => 'Employee\DashboardController@employeeUploadFile']);
    Route::match(['post'], 'employee-set-status', ['uses' => 'Employee\DashboardController@employeeSetStatus']);
	Route::match(['get', 'post'], 'employee-leave', ['as' => 'employee-leave', 'uses' => 'Employee\LeaveController@index']);
    Route::match(['get', 'post'], 'add-leave', ['as' => 'add-leave', 'uses' => 'Employee\LeaveController@leaveadd']);
	Route::match(['get', 'post'], 'edit-leave/{id}', ['as' => 'edit-leave', 'uses' => 'Employee\LeaveController@leaveedit']);
    Route::match(['get', 'post'], 'employee-ajaxAction', ['as' => 'employee-ajaxAction', 'uses' => 'Employee\LeaveController@ajaxAction']);
    Route::match(['get', 'post'], 'payroll-employee', ['as' => 'payroll-employee', 'uses' => 'Employee\PayrollController@payrollEmpList']);
    Route::match(['get', 'post'], 'employee-dashbord-ajaxAction', ['as' => 'employee-dashbord-ajaxAction', 'uses' => 'Employee\DashboardController@ajaxAction']);


    Route::get('manage-time-change-request', ['as' => 'manage-time-change-request', 'uses' => 'Employee\ManageTimeChangeRequestController@manageTimeChangeRequestList']);
    Route::match(['get', 'post'], 'new-time-change-request', ['as' => 'new-time-change-request', 'uses' => 'Employee\ManageTimeChangeRequestController@newTimeChangeRequest']);
    Route::match(['get', 'post'], 'requestlist-ajaxAction', ['as' => 'requestlist-ajaxAction', 'uses' => 'Employee\ManageTimeChangeRequestController@ajaxAction']);    

    /*TIckets Routes*/
    Route::match(['get', 'post'], 'ticket-list', ['as' => 'ticket-list-emp', 'uses' => 'Employee\TicketController@index']);
    Route::match(['get', 'post'], 'add-ticket', ['as' => 'add-ticket-emp', 'uses' => 'Employee\TicketController@add']);
    Route::match(['get', 'post'], 'ticket-ajaxAction', ['as' => 'ticket-ajaxAction-emp', 'uses' => 'Employee\TicketController@ajaxaction']);
    Route::match(['get', 'post'], 'download-attachment/{file}', ['as' => 'download-attachment-emp', 'uses' => 'Employee\TicketController@downloadAttachment']);
    Route::match(['get', 'post'], 'ticket-comments/{id}', ['as' => 'ticket-comments', 'uses' => 'Employee\TicketController@viewTicketComments']);
    
    Route::match(['get', 'post'], 'employee-pay-slip', ['as' => 'employee-pay-slip', 'uses' => 'Employee\PayslipController@create']);
    Route::match(['get', 'post'], 'employee-create-pdf', ['as' => 'employee-create-pdf', 'uses' => 'Employee\PayslipController@createPDF']);
    Route::match(['get', 'post'], 'employee-payslip-ajaxAction', ['as' => 'employee-payslip-ajaxAction', 'uses' => 'Employee\PayslipController@ajaxAction']);
    
    Route::match(['get', 'post'], 'employee-approved-advance-salary-request', ['as' => 'employee-approved-advance-salary-request', 'uses' => 'Employee\AdvanceSalaryRequestController@approvedRequestList']);
    Route::match(['get', 'post'], 'employee-createApprovedPdf', ['as' => 'employee-createApprovedPdf', 'uses' => 'Employee\AdvanceSalaryRequestController@createApprovedPdf']);
    Route::match(['get', 'post'], 'employee-downloadApprovedPdf', ['as' => 'employee-downloadApprovedPdf', 'uses' => 'Employee\AdvanceSalaryRequestController@downloadApprovedPdf']);
    Route::match(['get', 'post'], 'employee-createApprovedExcel', ['as' => 'employee-createApprovedExcel', 'uses' => 'Employee\AdvanceSalaryRequestController@createApprovedExcel']);
    
    Route::match(['get', 'post'], 'employee-daily-attendance', ['as' => 'employee-daily-attendance', 'uses' => 'Employee\AttendanceController@dailyAttendance']);
    
    Route::match(['get', 'post'], 'employee-attendance-report', ['as' => 'employee-attendance-report', 'uses' => 'Employee\AttendanceController@attendanceReport']);
    
    Route::match(['get', 'post'], 'employee-manage-attendance-history', ['as' => 'employee-manage-attendance-history', 'uses' => 'Employee\AttendanceController@manageAttendanceHistory']);
    Route::match(['get', 'post'], 'employee-attendance-history-ajaxAction', ['as' => 'employee-attendance-history-ajaxAction', 'uses' => 'Employee\AttendanceController@ajaxAction']);
    
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
    Route::match(['get', 'post'], 'emp-send-mail', ['as' => 'emp-send-mail', 'uses' => 'Employee\CommunicationController@sendMail']);

    /*Tasks*/
    Route::match(['get', 'post'], 'emp-task-list', ['as' => 'emp-task-list', 'uses' => 'Employee\TasksController@index']);
    Route::match(['get', 'post'], 'emp-task-ajaxAction', ['as' => 'emp-task-ajaxAction', 'uses' => 'Employee\TasksController@ajaxAction']);
    Route::match(['get', 'post'], 'emp-task-detail-download-attachment/{file_name}', ['as' => 'emp-task-detail-download-attachment/{file_name}', 'uses' => 'Employee\CommunicationController@downloadAttachment']);

    /*Training*/
    Route::match(['get', 'post'], 'employee-training', ['as' => 'employee-training', 'uses' => 'Employee\TrainingController@index']);
    Route::match(['get', 'post'], 'employee-training-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Employee\TrainingController@ajaxAction']);

    /*Award*/
    Route::match(['get','post'],'award',['as'=>'award','uses'=>'Employee\AwardController@index']);
    Route::match(['get', 'post'], 'award-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Employee\AwardController@ajaxAction']);
    Route::match(['get', 'post'], 'download-award-attachment/{file}', ['uses' => 'Employee\AwardController@downloadAttachment']);
    
       /*Performance*/
    Route::match(['get', 'post'], 'emp-performance', ['as' => 'emp-performance', 'uses' => 'Employee\PerformanceController@index']);
    Route::match(['get', 'post'], 'emp-employee-performance-list/{id}', ['as' => 'emp-employee-performance-list', 'uses' => 'Employee\PerformanceController@employeePerList']);
    Route::match(['get', 'post'], 'emp-performance-emp-detail/{id}', ['as' => 'emp-performance-emp-detail', 'uses' => 'Employee\PerformanceController@performanceEmpList']);
    Route::match(['get', 'post'], 'emp-performance-download-pdf', ['as' => 'emp-performance-download-pdf', 'uses' => 'Employee\PerformanceController@PerformanceDownloadPDF']);
    Route::match(['get', 'post'], 'emp-performance-ajaxAction', ['as' => 'emp-performance-ajaxAction', 'uses' => 'Employee\PerformanceController@ajaxAction']);

    Route::match(['get', 'post'], 'employee-sent-notification', ['as' => 'employee-sent-notification', 'uses' => 'Employee\NotificationController@sentNotification']);
    Route::match(['get', 'post'], 'employee-notification-list', ['as' => 'employee-notification-list', 'uses' => 'Employee\NotificationController@notificationList']);
    Route::match(['get', 'post'], 'notification-ajaxAction', ['as' => 'notification-ajaxAction', 'uses' => 'Employee\NotificationController@ajaxAction']);

    /* chat */
    Route::match(['get', 'post'], 'employee-chat', ['as' => 'employee-chat', 'uses' => 'Employee\ChatController@index']);
    Route::match(['get', 'post'], 'chat-ajaxAction', ['as' => 'employee-chat-ajaxAction', 'uses' => 'Employee\ChatController@ajaxAction']);
    
    
//    Role 
     Route::match(['get', 'post'],'employee-task-list', ['as' => 'employee-task-list', 'uses' => 'Employee\CompanyTaskController@index']);
    Route::match(['get', 'post'], 'employee-task-ajaxAction', ['as' => 'employee-task-ajaxAction', 'uses' => 'Employee\CompanyTaskController@ajaxAction']);
    Route::match(['get', 'post'], 'employee-add-task', ['as' => 'employee-add-task', 'uses' => 'Employee\CompanyTaskController@addTask']);

});
