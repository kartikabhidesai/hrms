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
            'title' => 'Employee List',
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
        //print_r($data['singleemployee']);exit;
        return view('company.payroll.payroll-employee-list', $data);
    }

    public function add(Request $request) {

        if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->addnewpayroll($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Payroll added successfully.';
                $return['redirect'] = route('payroll-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Create new payroll for ahmed',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.payroll.payroll-add', $data);
    }

}
