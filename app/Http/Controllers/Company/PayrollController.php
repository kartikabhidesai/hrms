<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Department;
use App\Model\Award;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;
use App\Model\Notification;
use App\Model\NotificationMaster;
use App\Model\UserNotificationType;
use App\Model\SendSMS;
class PayrollController extends Controller {

    public function __construct() {
         parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Employee List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard")));
       
        $data['departmentId'] = (empty($request->get('department'))) ? '' : $request->get('department');
        $data['employeeId'] = (empty($request->get('employee'))) ? '' : $request->get('employee');
        
        $EmpObj = new Employee;
        $userid = $this->loginUser->id; 
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['allemployee'] = $EmpObj->getAllEmployeeofCompany($companyId->id, $data['departmentId'] , $data['employeeId']);
        
        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId->id);   

        $objEmployee = new Employee();
        $data['employee'] = $objEmployee->getEmployee($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('');
        return view('company.payroll.payroll-list', $data);
    }

    public function payrollEmpList($id)
    {
        $data['detail'] = $this->loginUser;
        $EmpObj = new Employee;
        $data['singleemployee'] = $EmpObj->getAllEmployee($id);
         $data['header'] = array(
            'title' => 'Payroll '. $data['singleemployee']['name'] .' List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard")));
        $EmpObj = new Employee;

        $PayrollObj = new Payroll;
        $data['arrayPayroll'] = $PayrollObj->getPayroll($id);
        $data['empId'] = $id;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        
        return view('company.payroll.payroll-employee-list', $data);
    }

    public function add(Request $request,$id) {
        
        if($request->ajax()){
            /*echo '<pre>';
             print_r($request->extradeduction);exit;*/
            // if ($request->isMethod('post')) {
            $payrollobj = new Payroll();
            $ret = $payrollobj->addnewpayroll($request,$id);

            if ($ret == 'Exists') {
                $return['status'] = 'error';
                $return['message'] = 'Payroll Already Exists.';
                // $return['redirect'] = route('payroll-add',array('id'=> $id));
            } elseif ($ret == 'Added') {

                $objCompany = new Company();
                $company_id=$objCompany->getUseridById($request->input('companyId'));

                $notificationMasterId=2;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($company_id,$notificationMasterId);
                
                if($NotificationUserStatus->status==1)
                {
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
                       
                        if($result[0]['status'] == 1){
//                            SMS  Notification
                            $notificationMasterId=2;
                            $msg= "You have a new information in payroll.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaation($notificationMasterId,$id,$msg);
                        }
                        
                        if($result[1]['status'] == 1){
//                            EMAIL Notification
                            $notificationMasterId=2;
                            $msg= "You have a new information in payroll.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotification($notificationMasterId,$id,$msg);
                            
                            
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                            $objNotification = new Notification();
                            $objEmployee = new Employee();
                            $empName=$objEmployee->getAllEmployee($id);
                            $payrollName=$empName['name']." is a new information in payroll.";

                            $u_id=$objEmployee->getUseridById($id);
                            $route_url="payroll-employee";
                            $ret = $objNotification->addNotification($u_id,$payrollName,$route_url,$notificationMasterId);
                        
                        }
                }
                
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
         $data['payroll_setting'] = Employee::select("payroll_setting.grade","payroll_setting.basic_salary")
                                ->leftjoin('payroll_setting', 'employee.joining_salary', '=', 'payroll_setting.id')
                                ->where('employee.id',$id)->get();
//        
        $data['employee'] = Employee::find($id);
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Create new payroll',
            'breadcrumb' => array(
                'Home' => route("company-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');

        $data['js'] = array('company/payroll.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Payroll.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        
        return view('company.payroll.payroll-add', $data);
    } 
    public function edit(Request $request,$id)
    {   
        $data['payroll_setting'] = Payroll::select("payroll_setting.grade","payroll_setting.basic_salary")
                                ->leftjoin('employee', 'pay_roll.employee_id', '=', 'employee.id')
                                ->leftjoin('payroll_setting', 'employee.joining_salary', '=', 'payroll_setting.id')
                                ->where('pay_roll.id',$id)->get();
     
        $payrollObj = new Payroll;
        $arrayPayroll = $payrollObj->getPayrollV2($id);
        $data['decodeJsonOfAllowance'] = json_decode($arrayPayroll[0]['extra_allowance']);
        $data['arrayPayroll'] = $arrayPayroll[0];
        $data['decodeJsonOfDeduction'] = json_decode($arrayPayroll[0]['extra_deduction']);
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

                //notification add

               
            //    $company_id=$request->input('companyId');

               $objCompany = new Company();
                $company_id=$objCompany->getUseridById($request->input('companyId'));

                $notificationMasterId=2;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($company_id,$notificationMasterId);
                
                if($NotificationUserStatus==1)
                {
                    $objNotification = new Notification();
                    $objEmployee = new Employee();
                    $empName=$objEmployee->getAllEmployee($request->input('empId'));
                    $payrollName=$empName['name']." is a update information in payroll.";
                
                    $u_id=$objEmployee->getUseridById($request->input('empId'));
                    $route_url="payroll-employee";
                    $ret = $objNotification->addNotification($u_id,$payrollName,$route_url,$notificationMasterId);
                }

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
                'Home' => route("company-dashboard")));
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
            case 'getBankDetails':
                $postData = $request->input('data');
                $empDetail = Employee::find($postData['id']);
                echo json_encode($empDetail);exit;
                break;
            case 'saveBankDetails':
                $objEmployee = new Employee();
                $result = $objEmployee->editBankDetails($request->input('data'));
                if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Bank Details updated successfully.';
                        $return['jscode'] = "setTimeout(function(){
                                $('#updateBankModel').modal('hide');
                            },1000)";
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something will be wrong.';
                }
                echo json_encode($return);
                exit;
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

    public function payrollCheckAward(Request $request)
    {
        $count = 0;
        if($request->months != '' && $request->year != '' && $request->empid != '')
        {
            $from_date = $request->year.'-'.$request->months.'-1';
            $to_date = $request->year.'-'.$request->months.'-31';
            $awards = Award::where('employee_id',$request->empid)->whereBetween('date',[$from_date,$to_date])->get()->toArray();
            
            if($awards && !empty($awards))
            {
                
                foreach ($awards as $key => $value) {
                    $count = $count + $value['award'];
                }
            }
        }
        return $count;
    }

}
