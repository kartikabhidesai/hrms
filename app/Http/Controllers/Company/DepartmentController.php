<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Model\Department;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class DepartmentController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js');
        $data['funinit'] = array('Department.init()');
        $data['css'] = array('');
        return view('company.department.department-list', $data);
    }
    
    
    public function add(Request $request){
       
        if ($request->isMethod('post')) {
           $objDepartment=new Department();
           $result=$objDepartment->saveDepartment($request);
           if($result){
                $return['status'] = 'success';
                $return['message'] = 'Department created successfully.';
                $return['redirect'] = route('department-add');  
           }else{
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
           }
           echo json_encode($return);
           exit;
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js');
        $data['funinit'] = array('Department.add()');
        $data['css'] = array('');
        return view('company.department.department-add', $data);
    }
    
    
    public function edit($id){
        
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objEmployee = new Department();
                $demoList = $objEmployee->getdatatable();
                echo json_encode($demoList);
            break;
        }
    }

}