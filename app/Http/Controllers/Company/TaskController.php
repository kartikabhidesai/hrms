<?php
namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Department;
use App\Model\Designation;
use App\Model\Company;
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
    
    public function addTask(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/task.js');
        $data['funinit'] = array('Task.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Task Add' => 'Task'));
        return view('company.task.task-add', $data);
    }

}