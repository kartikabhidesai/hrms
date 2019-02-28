<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use App\Model\Employee;

class TasksController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function index(Request $request) {
         if ($request->isMethod('post')) {
             echo 'call'; exit;
         }
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/task.js');
        $data['funinit'] = array('Task.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Task List' => 'Task List'));
        $data['task_status']=['In_Progress','Pending','Complete'];
        return view('employee.task.task-list', $data);
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
                $objEmploye = new Task();
                $taskViewDetail = $objEmploye->getEmpviewTaskDetail($empId->id);
                echo json_encode($taskViewDetail);
                break;
                
        }
    }

}
