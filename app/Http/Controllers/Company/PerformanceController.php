<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Department;
use App\Model\Performance;

class PerformanceController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Performance Employee List',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));

        $data['departmentId'] = (empty($request->get('department'))) ? '' : $request->get('department');
        $data['employeeId'] = (empty($request->get('employee'))) ? '' : $request->get('employee');

        $EmpObj = new Employee;
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['allEmployee'] = $EmpObj->getAllEmployeeofCompany($companyId->id, $data['departmentId'], $data['employeeId']);

        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId->id);

        $objEmployee = new Employee();
        $data['employee'] = $objEmployee->getEmployee($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('');
        return view('company.performance.performance-list', $data);
    }

    public function performanceEmpList($id) {
        $data['detail'] = $this->loginUser;
        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployeeForPerformance($id);
        $data['header'] = array(
            'title' => 'Performance for ' . $data['singleemployee']['name'],
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        $EmpObj = new Employee;

        /* $PayrollObj = new Payroll;
          $data['arrayPayroll'] = $PayrollObj->getPayroll($id); */
        $data['empId'] = $id;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');

        return view('company.performance.performance-employee-detail', $data);
    }

    public function addPerformance(Request $request) {
        if ($request->isMethod('post')) {
           
            $objperformnce = new Performance();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            $ret = $objperformnce->addEmployeeperformance($request,$companyId->id);

            if ($ret) {
                
                $return['status'] = 'success';
                $return['message'] = 'Performance Added successfully.';
                $return['redirect'] = route('task-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while adding new performance!';
            }
            echo"<pre>";  print_r($return); exit();
             echo json_encode($return);
            exit;
        }
    }

}
