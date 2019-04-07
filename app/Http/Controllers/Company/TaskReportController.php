<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\TaskReport;
use App\Model\Employee;
use App\Model\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Model\Company;
use App\Model\Task;
use Auth;
use Route;
use APP;
use PDF;
use File;
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
            
            // print_r($postData);exit;
            $empEmplodeArray = explode(',', $empArray);
            $data['empArray']=$empEmplodeArray;
            $objTaskReport = new TaskReport();
            
            
                
                if(empty($postData['downloadstatus'])){
                    if($postData['emp_id']=='All')
                    {
                        $taskReportId = $objTaskReport->addTaskReport($postData,0,$companyId->id);

                        $objEmployee = new Employee();
                        $empEmplodeArray=$objEmployee->getEmployeeByDept($postData['dept_id']);
                        foreach ($empEmplodeArray as $key => $value) {
                            $getEmployeeArr = $objTaskReport->getTaskReportPdfDetail($taskReportId, $key, $companyId->id); 
                            // print_r($getEmployeeArr); 
                            if(!empty($getEmployeeArr)){
                                for($i=0;$i<count($getEmployeeArr);$i++)
                                {
                                    $dataPdf[$key][] = $getEmployeeArr[$i];
                                }
                            }
                        }
                    }else{
                        $taskReportId = $objTaskReport->addTaskReport($postData,$postData['emp_id'],$companyId->id);
                        foreach ($empEmplodeArray as $key => $value) {
                            $getEmployeeArr = $objTaskReport->getTaskReportPdfDetail($taskReportId, $value, $companyId->id); 
                            // print_r($getEmployeeArr); 
                            if(!empty($getEmployeeArr)){
                                for($i=0;$i<count($getEmployeeArr);$i++)
                                {
                                    $dataPdf[$value][] = $getEmployeeArr[$i];
                                }
                            }
                        }
                    }
                }
                
                // print_r($empEmplodeArray);
               
                // print_r($dataPdf);exit;
                if(count($dataPdf) > 0){

                    if (!file_exists(public_path('/uploads/task_report'))) {
                        mkdir(public_path('/uploads/task_report'),'0777',false);
                    }

                    $data['empPdfArray'] = $dataPdf;
                    $file_task_report= "task-report".$taskReportId.".pdf";
                    $pdf = PDF::loadView('company.task-report.task-pdf', $data);

                    $path = public_path(). "/uploads/task_report/".$file_task_report;                   

                    // PDF::loadHTML('company.task-report.task-pdf', $data) ->setPaper('a4', 'portrait') ->save($path);
                    // move_uploaded_file("pdf", $path);
                    $output = $pdf->output();
        // $file_to_save = FCPATH . 'assets/surat_acara/' . $new_filename . '.pdf';
                    file_put_contents($path, $output);
                    return $pdf->download($file_task_report);  
                }
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

    public function downloadTaskReport(Request $request,$file_name)
    {
        // echo "<pre>"; print_r($file_name); exit();
        $file = public_path(). "/uploads/task_report/".$file_name;
        if(file_exists($file))
        {
            return Response::download($file,$file_name);
            //  return $pdf->download($file);
        }else
        {
            return redirect('company/task-report')->with('status', 'file not found!');
        }
    }

}