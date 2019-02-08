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

class EmployeeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/employee.js');
        $data['funinit'] = array('Employee.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Employee List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Employee' => 'Employee'));
        return view('company.employee.employee-list', $data);
    }   

    public function add(Request $request) {
         if ($request->isMethod('post')) {
            $objUsers = new Users();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            
            $userId = $objUsers->addEmp($request);
            if ($userId == false) {
                $return['status'] = 'error';
                $return['message'] = 'Email Already Exists.!';
            }elseif ($userId) {
                $objEmployee = new Employee();
                $empId = $objEmployee->addEmployee($request,$userId, $companyId->id);
                // $ret = $objEmployee->updateEmpId($empId,$userId);
                $return['status'] = 'success';
                $return['message'] = 'Employee created successfully.';
                $return['redirect'] = route('employee-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
        'title' => 'Employee Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Employee List' => route("employee-list"),
                'Employee Add' => '',
            ));

        $objdepartment = new Department();
        $objDesignation = new Designation();
        $data['ArrDepartment'] = $objdepartment->getDepartment();
        $data['ArrDesignation'] = $objDesignation->getDesignation();
        $data['testarray'] = Config::get('constants.testarray');
        $data['statusArray'] = Config::get('constants.statusArray');
        $data['genderArray'] = Config::get('constants.genderArray');
        $data['martialArray'] = Config::get('constants.martialArray');
        $data['nationalityArray'] = Config::get('constants.nationalityArray');

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/employee.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Employee.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Employee',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Employee' => route("employee-list"),
                'Add Employee'=>'Add Employee'));
        return view('company.employee.employee-add', $data);
    } 
    
    public function edit(Request $request,$id) {
        $data['details'] = Employee::find($id);
        if ($request->isMethod('post')) {
            $objEmployee = new Employee();
            $res = $objEmployee->editEmployee($request,$id);
            if ($res) {
                $return['status'] = 'success';
                $return['message'] = 'Employee updated successfully.';
                $return['redirect'] = route('employee-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'Employee',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Employee' => route("employee-list"),
                'Edit Employee'=>'Edit Employee'));
        $data['testarray'] = Config::get('constants.testarray');
        $data['statusArray'] = Config::get('constants.statusArray');
        $data['genderArray'] = Config::get('constants.genderArray');
        $data['martialArray'] = Config::get('constants.martialArray');
        $data['nationalityArray'] = Config::get('constants.nationalityArray');
        $objdepartment = new Department();
        $objDesignation = new Designation();
        $data['ArrDepartment'] = $objdepartment->getDepartment();
        $data['ArrDesignation'] = $objDesignation->getDesignation();
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/employee.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Employee.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.employee.employee-edit', $data);
    }


    public function deleteEmp($postData) {
        if ($postData) {
            $findEmp = Employee::where('id', $postData['id'])->first();
            if($findEmp) {
                $deleteUser = Users::where('id', $findEmp->user_id)->delete();
            }
            $result = Employee::where('id', $postData['id'])->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Employee delete successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#employeeDatatables').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objEmployee = new Employee();
                $userid = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userid)->first();
                $demoList = $objEmployee->getEmployeeDatatable($request, $companyId->id);
                echo json_encode($demoList);
                break;
            case 'deleteEmp':
                $result = $this->deleteEmp($request->input('data'));
                break;
        }
    }


}