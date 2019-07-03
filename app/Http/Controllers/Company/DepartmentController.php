<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Model\Department;
use App\Model\Designation;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use Config;

class DepartmentController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function index(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js');
        $data['funinit'] = array('Department.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Department' => 'Department'));
        return view('company.department.department-list', $data);
    }
    
    public function add(Request $request)
    {
        $session = $request->session()->all();

        if ($request->isMethod('post')) {
            $objDepartment = new Department();
            $result = $objDepartment->saveDepartment($request);
            if($result) {
                $return['status'] = 'success';
                $return['message'] = 'Department created successfully.';
                $return['redirect'] = route('department-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js', 'jquery.form.min.js');
        $data['funinit'] = array('Department.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['css_plugin'] = array(
                                  'bootstrap-fileinput/bootstrap-fileinput.css',  
                                );
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Department' => route("department-list"),
                'Add Department'=>'Add Department'));
        return view('company.department.department-add', $data);
    }
    
    public function edit(Request $request, $id)
    {
        $data['detail'] = Department::with('designation')->find($id);
        
        if ($request->isMethod('post')) {
            $objDepartment = new Department();
            $ret = $objDepartment->editDepartment($request);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('department-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Please add any one designation!';
            }

            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js', 'jquery.form.min.js');
        $data['funinit'] = array('Department.edit()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Department' => route("department-list"),
                'Edit Department'=>'Edit Department'));

        return view('company.department.department-edit', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objEmployee = new Department();
                $demoList = $objEmployee->getdatatable();
                echo json_encode($demoList);
            break;
            case 'deleteDepartment':
                $result = $this->deleteDepartment($request->input('data'));
                break;
            case 'getCompnanyDepartmentList':
                $result = $this->getCompnanyDepartmentList1();                
                break;

        }
    }

    public function deleteDepartment($postData) 
    {
        if ($postData) 
        {
            $findDesignation = Designation::where('department_id', $postData['id'])->get();
            $findDepartment = Department::where('id', $postData['id'])->first();
            $deleteDesignation = $findDepartment->designation()->delete();
            $result = $findDepartment->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                //$return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#DepartmentDatatables').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function getCompnanyDepartmentList1() 
    {
        // $session = $request->session()->all();
        // $userId = $this->loginUser->id;
        // $companyId = Company::select('id')->where('user_id', $userId)->first();
        $objdepartment = new Department();
        $data1 = Department::select('id','department_name')->get();
        // $return['status'] = 'success';
        // $return['message'] = 'Record deleted successfully.';
        echo json_encode($data1);
    }


}