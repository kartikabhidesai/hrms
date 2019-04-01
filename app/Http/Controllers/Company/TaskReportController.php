<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\TaskReport;
use App\Model\Employee;
use App\Model\Department;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Task;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;



class TaskReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $userid = $session['logindata'][0]['id'];
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $data['departments'] = Department::where('company_id', $companyId['id'])->get();
        $dataPdf = array();
        if ($request->isMethod('post')) {
            $postData = $request->input();
            // print_r($postData);exit;
            $empArray = $postData['emparray'];
            $empEmplodeArray = explode(',', $empArray);
            foreach ($empEmplodeArray as $key => $value) {
                $objTaskReport = new TaskReport();
                if(empty($postData['downloadstatus'])){
                    $employeeArr = $objTaskReport->addTaskReport($postData,$value);    
                }
                
                $employeeArr = $objTaskReport->getTaskReportPdfDetail($postData,$value);  
                    if(!empty($employeeArr)){
                        for($i=0;$i<count($employeeArr);$i++)
                        {
                            $dataPdf[] = $employeeArr[$i];
                        }
                    }
                }
            }
            // print_r($dataPdf);exit;
            if(count($dataPdf) > 0){
                $data['empPdfArray'] = $dataPdf;
                $file= date('dmYHis')."task-system.pdf";
                $pdf = PDF::loadView('company.task-report.task-pdf', $data);
                return $pdf->download($file);    
            }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/task-report.js');
        $data['funinit'] = array('TaskReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Task Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Task Report' => 'task-report'));

                $objdepartment = new Department();
                $objEmployee = new Employee();
                $data['department'] = $objdepartment->getDepartment();
                $data['employee'] = $objEmployee->getEmployee($companyId->id);
                // print_r($companyId);exit;
        return view('company.task-report.task-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $objTaskReport = new TaskReport();
                $taskReportList = $objTaskReport->getTaskReportList($request, $companyId->id);
                echo json_encode($taskReportList);
                break;

            case 'taskReportDetails':
                $result = $this->getTaskReportDetails($request->input('data'));
                break;

            case'deleteTaskSystem':
                $result = $this->deleteTask($request->input('data'));
                break;
        }
    }

    public function deleteTask($postData) {
        if ($postData) {
            $findAnnounmnt = TaskReport::where('id', $postData['id'])->first();
            $result = $findAnnounmnt->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        location.reload();
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