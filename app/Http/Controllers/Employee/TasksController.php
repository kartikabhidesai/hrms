<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Notification;
use App\Model\NotificationMaster;
use App\Model\TaskComments;
use File;
use Config;

class TasksController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function index(Request $request) {

        if ($request->isMethod('post')) {
            $userID = $this->loginUser->id;
            $empId = Employee::select('id','name','company_id')->where('user_id', $userID)->first();
            $objEmploye = new Task();
            // print_r($request);
            // print_r($empId);
            // exit;
            $res = $objEmploye->updateTaskDetailEmp($request, $empId->id);
            if ($res) {

                $objCompany = new Company();
                $u_id=$objCompany->getUseridById($empId->company_id);

                $notificationMasterId=15;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($u_id,$notificationMasterId);
                
                if($NotificationUserStatus==1)
                {
                    $taskRequestName=$empId->name." update the task.";
                    
                    $route_url="task-list";
                    $objNotification = new Notification();
                    $ret = $objNotification->addNotification($u_id,$taskRequestName,$route_url,$notificationMasterId);
                }

                $return['status'] = 'success';
                $return['message'] = 'Task updated successfully.';
                $return['redirect'] = route('emp-task-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong while creating new task!';
            }
            echo json_encode($return);

            exit();
        }
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/task.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Task.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Task List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Task List' => 'Task List'));
        $data['task_progress'] = Config::get('constants.task_progress');
        $data['task_status'] = ['In Progress', 'Pending', 'Complete'];
        return view('employee.task.task-list', $data);
    }
    
    public function taskComment(Request $request,$id){
       if ($request->isMethod('post')) {
         
            $objTaskComment = new TaskComments();
            $result = $objTaskComment->addComments($request);
            if($result) {
                $return['status'] = 'success';
                $return['message'] = 'Task Comment successfully.';
                // $rt='ticket-comments/'.$id;
                $return['redirect'] = $id;
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }

            echo json_encode($return);
            exit;
            
        }
        $objTaskComment = new TaskComments();
        $task_comment = $objTaskComment->getTaskCommentDetails($id);
        $data['ticket_comment'] = $task_comment;
        $objTask = new Task();
        $data['taskDetails']= $objTask->taskDetails($id);
        $data['taskprocess'] = ['0'=>'New','1'=>'In Progess','2'=>'Pending','3'=>'Complete'];
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/task.js');
        $data['funinit'] = array('Task.comments()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Comments',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Task List' => route("emp-task-list"),
                'Task Comments' => 'Task Comments'));
        return view('employee.task.task-comments', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $empId = Employee::select('id')->where('user_id', $userID)->first();
                $objEmploye = new Task();
                $taskList = $objEmploye->getEmpTaskList($empId->id);
                echo json_encode($taskList);
                break;
            case 'getTaskDetails':
                $userID = $this->loginUser->id;
                $empId = Employee::select('id')->where('user_id', $userID)->first();
                $taskId = $request->input('data');
                $objEmploye = new Task();
                $taskViewDetail = $objEmploye->getEmpviewTaskDetail($taskId,$empId->id);
                echo json_encode($taskViewDetail);
                break;
        }
    }

}
