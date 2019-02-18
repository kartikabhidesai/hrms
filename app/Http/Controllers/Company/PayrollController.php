<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Company;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;

class PayrollController extends Controller {

    public function __construct() {
         parent::__construct();
        $this->middleware('company');
    }

    public function index() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Employee List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $EmpObj = new Employee;
       
        $userid = $this->loginUser->id; 
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['allemployee'] = $EmpObj->getAllEmployeeofCompany($companyId->id);

        return view('company.payroll.payroll-list', $data);
    }

    public function payrollEmpList($id) {
        $data['detail'] = $this->loginUser;
        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployee($id);
         $data['header'] = array(
            'title' => 'Payroll '. $data['singleemployee']['name'] .' List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $EmpObj = new Employee;

        $PayrollObj = new Payroll;
        $data['arrayPayroll'] = $PayrollObj->getPayroll($id);
        $data['empId'] = $id;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        //print_r($data['singleemployee']);exit;
        return view('company.payroll.payroll-employee-list', $data);
    }

    public function add(Request $request,$id) {

        if($request->ajax()){
            echo '<pre>';
             print_r($request->input());exit;
        // if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->addnewpayroll($request,$id);

            if ($ret == 'Exists') {
                $return['status'] = 'error';
                $return['message'] = 'Payroll Already Exists.';
                // $return['redirect'] = route('payroll-add',array('id'=> $id));
            }elseif ($ret == 'Added') {
                $return['status'] = 'success';
                $return['message'] = 'Payroll added successfully.';
                $return['redirect'] = route('payroll-emp-detail',array('id'=> $id));
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['monthis'] = Config::get('constants.months');
        $data['employee'] = Employee::find($id);
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Create new payroll',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');

        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.payroll.payroll-add', $data);
    } 
    public function edit(Request $request,$id) {
        $payrollObj = new Payroll;
        $arrayPayroll = $payrollObj->getPayrollV2($id);
        $data['arrayPayroll'] = $arrayPayroll[0];
        $data['employee'] = Employee::find($data['arrayPayroll']['employee_id']);
        if($request->ajax()){
        // if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->editPayroll($request,$id);
            if ($ret == 'Exists' &&  $ret != true) {
                $return['status'] = 'error';
                $return['message'] = 'Payroll Already Exists.';
                // $return['redirect'] = route('payroll-add',array('id'=> $id));
            }elseif ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Payroll updated successfully.';
                $return['redirect'] = route('payroll-emp-detail',array('id'=> $request->input('empId')));
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['monthis'] = Config::get('constants.months');
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Create new payroll',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');

        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.payroll.payroll-add', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            
            case 'deletePayroll':
                $result = $this->deletePayroll($request->input('data'));
                break;
        }
    }

    public function deletePayroll($postData) 
    {
        if ($postData) 
        {
            $result = Payroll::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
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

}
