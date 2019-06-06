<?php
namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Department;
use App\Model\Company;
use App\Model\Task;
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

class CompanyTaskController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function index(Request $request)
    {
        
        $session = $request->session()->all();
        $userId = $session['logindata'][0]['id'];
        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userId);        
        Session::put('notificationdata', $items);
        
        $data['priority'] = "";
        $data['status'] = "";
        
        if($request->method('get')){
            $data['priority'] = $request->input('priority');
            $data['status'] = $request->input('status');
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/Companytask.js');
        $data['funinit'] = array('Task.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Task List' => 'Task'));

        return view('employee.companytask.task-list', $data);
    } 
    
    public function addTask(Request $request)
    {
        
        $session = $request->session()->all();
        
        $userid = $this->loginUser->id;
        $companyId = Employee::select('company_id')->where('user_id', $userid)->get();
       
        $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
//        print_r();
//        die();
        $company_Id = $companyId[0]['company_id'];
        
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            
            $objNonWorkingDate = new NonWorkingDate();
            $resultNonWorkingDate = $objNonWorkingDate->getCompanyNonWorkingDateArrayList($company_Id);
           
            if(in_array(date('Y-m-d',strtotime($request->input('assign_date'))), $resultNonWorkingDate)) {
                $return['status'] = 'error';
                $return['message'] = $request->input('assign_date'). ' is Non Working Date';
            }else{
                $objCompany = new Task();
                $ret = $objCompany->addTask($request, $company_Id);

                if ($ret) {
                    //notification add
                    $notificationMasterId=1;
                    $objNotificationMaster = new NotificationMaster();
                    $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($userID[0]->user_id,$notificationMasterId);
                    
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
                    $return['redirect'] = route('employee-task-list');
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
        $data['department'] = $objdepartment->getDepartmentCompany($company_Id);
        $data['employee'] = $objDesignation->getEmployee($company_Id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/Companytask.js', 'jquery.form.min.js');
        $data['funinit'] = array('Task.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Add',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Task Add' => 'Task'));

        return view('employee.companytask.task-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        $userid = $this->loginUser->id;
        $companyId = Employee::select('company_id')->where('user_id', $userid)->get();
        
        $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
        switch ($action) {
            case 'getdatatable':
                $objtask = new Task();
                $taskList = $objtask->getTaskList($request, $companyId[0]->company_id);
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

}