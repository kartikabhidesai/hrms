<?php
namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Department;
use App\Model\Company;
use App\Model\Task;
use App\Model\TaskComments;
use App\Model\NonWorkingDate;
use App\Model\Notification;
use App\Model\NotificationMaster;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Config;
use APP;
use Session;
use Illuminate\Http\Request;

class TaskController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request)
    {
        
        $session = $request->session()->all();
        
        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        
        $companyId = Company::select('id')->where('user_id', $userID->id)->first();
       
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);
        $objtaskpriority = new Task();
        $data['highPriority'] = $objtaskpriority->highPriority($companyId['id']);
        $data['normalPriority'] = $objtaskpriority->normalPriority($companyId['id']);
        $data['lowPriority'] = $objtaskpriority->lowPriority($companyId['id']);
        $data['priority'] = "";
        $data['status'] = "";
        
        if($request->method('get')){
            $data['priority'] = $request->input('priority');
            $data['status'] = $request->input('status');
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/task.js');
        $data['funinit'] = array('Task.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Task List' => 'Task'));

        return view('company.task.task-list', $data);
    } 
    
    public function addTask(Request $request)
    {
        $session = $request->session()->all();
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        if ($request->isMethod('post')) {
            
            $objNonWorkingDate = new NonWorkingDate();
            $resultNonWorkingDate = $objNonWorkingDate->getCompanyNonWorkingDateArrayList($companyId->id);
           
            if(in_array(date('Y-m-d',strtotime($request->input('assign_date'))), $resultNonWorkingDate)) {
                $return['status'] = 'error';
                $return['message'] = $request->input('assign_date'). ' is Non Working Date';
            }else{
                $objCompany = new Task();
                $ret = $objCompany->addTask($request, $companyId->id);

                if ($ret) {
                    //notification add
                    $notificationMasterId=1;
                    $objNotificationMaster = new NotificationMaster();
                    $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($userId,$notificationMasterId);
                    
                    if($NotificationUserStatus==1)
                    {
                        $objNotification = new Notification();
                        $taskName=$request->input('task')." is a new task.";
                        $objEmployee = new Employee();
                        $u_id=$objEmployee->getUseridById($request->input('employee'));
                        $route_url="emp-task-list";
                        $ret = $objNotification->addNotification($u_id,$taskName,$route_url,$notificationMasterId);
                    }
                    
                    $return['status'] = 'success';
                    $return['message'] = 'Task created successfully.';
                    $return['redirect'] = route('task-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Somethin went wrong while creating new task!';
                }
            }
            echo json_encode($return);
            exit;
        }
        $objdepartment = new Department();
        $objDesignation = new Employee();
        $data['department'] = $objdepartment->getDepartment();
        $data['employee'] = $objDesignation->getEmployee($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/task.js', 'jquery.form.min.js');
        $data['funinit'] = array('Task.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Task Add' => 'Task'));

        return view('company.task.task-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        $userID = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userID)->first();
        switch ($action) {
            case 'getdatatable':
                $objtask = new Task();
                $taskList = $objtask->getTaskList($request, $companyId->id);
                echo json_encode($taskList);
                break;

                case 'taskDetails':
                $result = $this->getTaskDetails($request->input('data'));
                break; 
                case 'checkDate':
                    $nonWorkingDay = new NonWorkingDate();
                    $result = $nonWorkingDay->getNonWorkingDate($request->input('date'),$companyId);
                    if ($result) {
                        $return['status'] = 'error';
                        $return['message'] = $request->input('date'). ' is Non Working Date';
                        $return['counts'] = $result;
                    } else {
                        $return['status'] = '';
                        $return['message'] = '';
                        $return['counts'] = '0';
                    }
                    echo json_encode($return);
                    exit;

                    break;
        }
    }

    public function getTaskDetails($postData)
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $taskDetails = Task::select('tasks.task', 'tasks.priority', 'tasks.about_task', 'tasks.complete_progress', 'tasks.task_status', 'tasks.employee_id', 'emp.name as emp_name')
                            ->join('employee as emp', 'tasks.employee_id', '=', 'emp.id')
                            ->where('tasks.id', $postData)
                            ->first();

        echo json_encode($taskDetails);
        exit;
    }
    
    public function taskComments(Request $request,$id){
        
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
        $data['js'] = array('company/task.js');
        $data['funinit'] = array('Task.comments()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Comments',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Task List' => route("task-list"),
                'Task Comments' => 'Task Comments'));
        return view('company.task.task-comments', $data);
    }
}