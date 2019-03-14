<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Department;
use App\Model\Performance;
use Config;
use PDF;

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
        $data['js'] = array('company/performance.js');
        $data['funinit'] = array('Performance.init()');
        $data['css'] = array('');
        return view('company.performance.performance-list', $data);
    }

    public function performanceEmpList($id , Request $request) {
        $data['detail'] = $this->loginUser;
        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployeeForPerformance($id);

        $data['header'] = array(
            'title' => 'Performance for ' . $data['singleemployee']['name'],
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        
        $data['empId'] = $id;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/performance.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Performance.init()');
        $data['css'] = array();
        $data['monthis'] = Config::get('constants.months');
        return view('company.performance.performance-employee-detail', $data);
    }

    public function employeePerList($id,Request $request) {
        $data['detail'] = $this->loginUser;
        $id=1;
        $performanceObj = new Performance;
        $data['employeePerfirmance'] = $performanceObj->getEmployeePerformanceList($id);

        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployeeForPerformance($id);

        $data['header'] = array(
            'title' => 'Performance for ' . $data['singleemployee']['name'],
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));

        $data['empId'] = $id;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/performance.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Performance.init()');
        $data['css'] = array();
        $data['monthis'] = Config::get('constants.months');
        return view('company.performance.performance-employee-list', $data);
    }

    public function addPerformance(Request $request) {
        if ($request->isMethod('post')) {
           
            $objperformnce = new Performance();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            $ret = $objperformnce->addEmployeeperformance($request,$companyId->id);
            if ($ret=='Exist' && $ret != 1) {
                $return['status'] = 'error';
                $return['message'] = 'Performance Already Exist.';
            }elseif ($ret == 1) {
                $return['status'] = 'success';
                $return['message'] = 'Performance Added successfully.';
                $return['redirect'] = route('employee-performance-list',array('id' => $request->input('employee_id')));
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while adding new performance!';
            }
             echo json_encode($return);
            exit;
        }
    }

    public function PerformanceDownloadPDF(Request $request)
    {   
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
       
        $performanceObj = new Performance;
        $data['empPdfArray'] = $performanceObj->getEmployeePerformanceDetailsList($companyId->id);
           
        $file= date('d-m-YHis')."performance.pdf";
        $pdf = PDF::loadView('company.performance.performance-list-pdf', $data);
        return $pdf->download($file);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $performanceObj = new Performance;
                $performanceList = $performanceObj->getPerformanceList($request, $companyId->id);
                echo json_encode($performanceList);
                break;
        }
    }

}
