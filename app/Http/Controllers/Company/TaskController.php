<?php
namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Department;
use App\Model\Company;
use App\Model\Task;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Config;
use APP;
use Illuminate\Http\Request;

class TaskController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
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
            
            $objCompany = new Task();
            $ret = $objCompany->addTask($request, $companyId->id);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Task created successfully.';
                $return['redirect'] = route('task-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while creating new task!';
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
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $objEmploye = new Task();
                $taskList = $objEmploye->getTaskList($companyId->id);
                echo json_encode($taskList);
                break;
            /*case 'deleteLeave':
                $result = $this->deleteLeave($request->input('data'));
                break;*/
        }
    }

}