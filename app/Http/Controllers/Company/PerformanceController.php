<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Department;
use App\Model\Performance;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Config;
use PDF;
use App\Model\UserNotificationType;
use App\Model\SendSMS;
use App\Model\Users;
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
                'Home' => route("admin-dashboard"))
        );

        $data['departmentId'] = (empty($request->get('department'))) ? '' : $request->get('department');
        $data['employeeId'] = (empty($request->get('employee'))) ? '' : $request->get('employee');

        $EmpObj = new Employee;
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        if ($request->isMethod('post')) {
            
            $postData = $request->input();
            $empArray = $postData['empchk'];
            // print_r($empArray);exit;
            $data['emparray']=$empArray;
            $dataPdf = array();
            foreach ($empArray as  $value) {
                $performanceObj = new Performance;
                $employeeArr = $performanceObj->getEmployeePerformanceDetailsList($value,$companyId->id);
                   // dd($employeeArr[0]);
                if(!empty($employeeArr)){
                    $dataPdf[$value] = $employeeArr;
                }
            }
            // 
            if(count($dataPdf) > 0){
                $data['empPdfArray'] = $dataPdf;
                // print_r($data);exit;
                $file= date('d-m-YHis')."performance.pdf";
                $pdf = PDF::loadView('company.performance.performance-list-pdf', $data);
                return $pdf->download($file);
            }
            
        }
        
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
        $performanceObj = new Performance;
        $data['employeePerfirmance'] = $performanceObj->getEmployeePerformanceList($id);
        
        $performanceObj = new Performance;
        $data['lastPerformance'] = $performanceObj->lastPerformance($id);
        
        
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
           $id=$request->input('employee_id');
            $objperformnce = new Performance();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            $ret = $objperformnce->addEmployeeperformance($request,$companyId->id);
            if ($ret=='Exist' && $ret != 1) {
                $return['status'] = 'error';
                $return['message'] = 'Performance Already Exist.';
            }elseif ($ret == 1) {


                $notificationMasterId=4;
                $objNotificationMaster = new NotificationMaster();
               $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($userid,$notificationMasterId);
               
                if($NotificationUserStatus->status==1)
                {
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
                       
                        if($result[0]['status'] == 1){
//                            SMS  Notification
                            $notificationMasterId=4;
                            $msg= "Performance is a new evaluates update.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaation($notificationMasterId,$id,$msg);
                        }
                        
                        if($result[1]['status'] == 1){
//                            EMAIL Notification
                            $notificationMasterId=4;
                            $msg= "Performance is a new evaluates update.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotification($notificationMasterId,$id,$msg);
                            
                            
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                            //notification add
                            $objNotification = new Notification();
                            $performanceName="Performance is a new evaluates update.";
                            $objEmployee = new Employee();
                            $u_id=$objEmployee->getUseridById($request->employee_id);
                            $route_url="emp-performance";
                            $ret = $objNotification->addNotification($u_id,$performanceName,$route_url,$notificationMasterId);
                        }
                }

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
        $postData = $request->input();
        $empArray = $postData['empchk'];

        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
       
        $performanceObj = new Performance;
        $data['empPdfArray'] = $performanceObj->getEmployeePerformanceDetailsList($empArray, $companyId->id);
           
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
            case 'getPerformancePercentage':
                if($request->empid != '' && $request->time_period != '')
                {
                    
                    $performanceObj = new Performance;
                    $performanceList = $performanceObj->getEmployeePerformanceList($request->empid);

                    $emp_time = explode('-',$request->time_period);
                   
                    $newtimeYear = date("Y",strtotime("-".$emp_time[0]." ".$emp_time[1]));
                    $newtimeMonth = date("m",strtotime("-".$emp_time[0]." ".$emp_time[1]));
                    
                    // echo "<pre>"; print_r($emp_time[0].' - '.$emp_time[1].' - '.$newtimeYear.' - '.$newtimeMonth);
                    
                    $emp_total = $count = 0;
                    if (isset($performanceList) && !empty($performanceList)) 
                    {
                        foreach ($performanceList as $key => $value)
                        {
                            $temp_check = false;
                            if((int)$newtimeYear < (int)$value['year'])
                            {
                                $temp_check = true;
                            }
                            elseif ($newtimeYear == $value['year']) 
                            {
                                if((int)$newtimeMonth <= (int)$value['month'])
                                {
                                    $temp_check = true;
                                }
                            }

                            if ($temp_check == true) 
                            {
                                $emp_total = $emp_total+(int)$value['availability']+
                                    (int)$value['dependability']+
                                    (int)$value['job_knowledge']+
                                    (int)$value['quality']+
                                    (int)$value['productivity']+
                                    (int)$value['working_relationship']+
                                    (int)$value['honesty'];
                                $count++;
                            }
                        }
                       
                        if ($count != 0) 
                        {
                            $grand_total = 5 * 7 * $count; 
                            $percentage = round((($emp_total*100)/$grand_total),2);    
                            return ['status'=>'success','percentage'=>$percentage];
                        }
                        else
                        {
                            return ['status'=>'error','message'=>'No record found'];
                        }
                    }
                    else
                    {
                        return ['status'=>'error','message'=>'No record found'];
                    }
                }
                else
                {
                    return ['status'=>'error','message'=>'Please select value'];
                }
                break;
        }
    }

}
