<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;

class PayrollController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function index() {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Employee List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $EmpObj = new Employee;
        $data['allemployee'] = $EmpObj->getAllEmployee();

        return view('company.payroll.payroll-list', $data);
    }

    public function payrollEmpList($id) {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Ahmed List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployee($id);
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
        // if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->addnewpayroll($request,$id);
            if ($ret) {
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

        if($request->ajax()){
        // if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->editPayroll($request,$id);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Payroll added successfully.';
                $return['redirect'] = route('payroll-emp-detail',array('id'=> $request->input('empId')));
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

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
