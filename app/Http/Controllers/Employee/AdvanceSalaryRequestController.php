<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;
use App\Model\Advancesalary;
use App\Model\Company;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Response;
use Config;
use Excel;
use Session;

class AdvanceSalaryRequestController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }
    
    public function requestList(Request $request){

        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);

        
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Advance Salary Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Advance Salary Request' => 'Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js');
        $data['funinit'] = array('Advancesalaryrequest.init()');
        $data['css'] = array('');

        return view('employee.advancesalaryrquest.request-list', $data);
    }
    
    public function newRequest(Request $request){
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        
        $objEmployee=new Employee();
        $data['empdetails']=$objEmployee->getEmploydetails($logindata['id']);       
        // print_r($data['empdetails']);exit;
        if ($request->isMethod('post')) {
            $objNewSalaryRequest= new Advancesalary();
            $result=$objNewSalaryRequest->addSalaryRequest($request);
            if ($result) {
                
                $objCompany = new Company();
                $u_id=$objCompany->getUseridById($data['empdetails'][0]['company_id']);

                $notificationMasterId=12;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($u_id,$notificationMasterId);
                
                if($NotificationUserStatus==1)
                {
                
                    $seleryRequestName=$request->input('emp_name')." selery request you.";                   
                    $objNotification = new Notification();
                    $route_url="campany-advance-salary-request";
                    $ret = $objNotification->addNotification($u_id,$seleryRequestName,$route_url,$notificationMasterId);
                }

                $return['status'] = 'success';
                $return['message'] = 'New Advance Salary  Request created successfully.';
                $return['redirect'] = route('advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'New Advance Salary Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Advance Salary Request list' => route('advance-salary-request'),
                'New Advance Salary Request' => 'New Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Advancesalaryrequest.add()');
        $data['css'] = array('');

        return view('employee.advancesalaryrquest.new-request-list', $data);
    }
    
    public function editRequest(Request $request,$id){
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        
        $objEmployee=new Employee();
        $data['empdetails']=$objEmployee->getEmploydetails($logindata['id']);       
        
        $objAdvanceSalary=new Advancesalary();
        $data['result']=$objAdvanceSalary->getAdavanceDetails($id);
       
        if ($request->isMethod('post')) {
            $objNewSalaryRequest= new Advancesalary();
            $result=$objNewSalaryRequest->editSalaryRequest($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Advance Salary  Request edited successfully.';
                $return['redirect'] = route('advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'Edit Advance Salary Request List',
            'breadcrumb' => array(
                'Home / Edit Advanc Salary Request' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Advancesalaryrequest.edit()');
        $data['css'] = array('');
        return view('employee.advancesalaryrquest.edit-request-list', $data);
    }
    
    public function deleteLeave($postData) {
        if ($postData) {
            $result = Advancesalary::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Advance salary request delete successfully.';
                 $return['redirect'] = route('advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
    
    public function approvedRequestList(Request $request)
    {
        $data['monthis'] = Config::get('constants.months');
        $id = Auth()->guard('employee')->user()['id'];
        
        $companyId = Employee::select('company_id')->where('user_id', $id)->first();
        
        $data['get_year'] = $request->get('year');
        $data['get_month'] = $request->get('month');
        $data['month'] = $request->get('month');

        $objAdvanceSalary = new Advancesalary();
        $data['datalist'] = $objAdvanceSalary->getCompanyApprovedAdvanceSalaryListV2($companyId['company_id'],$data['get_year'],$data['month']);

        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Approved Salary Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Approved Advance Salary Request' => 'Approved Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequestnew.js');
        $data['funinit'] = array('Advancesalaryrequest.initApprovedReqList()');
        $data['css'] = array('');

        return view('employee.advancesalaryrquest.approved-request-list', $data);
    }
    
    public function createApprovedPdf(Request $request){
        if($request->method('post')){
            $objAdvanceSalary=new Advancesalary();
            $data['advanceSalaryApprovedRequest']=$objAdvanceSalary->getDetails($request);
            $pdf = PDF::loadView('employee.advancesalaryrquest.advance-salary-rquest-pdf', compact('data'));
            $pdfName='advance-salary'.time().'.pdf';
            $pdf->save(public_path('uploads/employee/'.$pdfName));
            return $pdfName;
        }
    } 
    
    public function downloadApprovedPdf(Request $request){
        if($request->method('get')){
            $pdfName=$request->input('pdfname');
            $file=public_path('uploads/employee/'.$request->input('pdfname'));
            return Response::download($file, $pdfName);
        }
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        
        switch ($action) {
            
            case 'getdatatable':
                $id = Auth()->guard('employee')->user()['id'];
                
                $objEmploye=new Employee();
                $employeid=$objEmploye->getUserid($id);
                $objAdvanceSalary=new Advancesalary();
                $datalist=$objAdvanceSalary->getAdvanceSalaryList($employeid);
                echo json_encode($datalist);
                break;
            case 'deleteLeave':
                $result = $this->deleteLeave($request->input('data'));
                break;
        }
    }
    
    public function createApprovedExcel(Request $request){
        if($request->method('post')){
            
            $objAdvanceSalary=new Advancesalary();
            $advanceSalaryApprovedRequest = $objAdvanceSalary->getDetailsV2($request);
            
            Excel::create('Approved Advance Salary Request-'.date('dmY'), function($excel) use ($advanceSalaryApprovedRequest){
                $headers = array('Name', 'Comment', 'Date of Submit', 'Department Name', 'Company Name','Phone');
                        $excel->sheet("Student_Offers_List", function($sheet) use ($headers, $advanceSalaryApprovedRequest) {
                        for ($i = 0; $i < count($advanceSalaryApprovedRequest); $i++) {
                            $sheet->prependRow($headers);
                            $sheet->fromArray(array(
                                array(
                                    $advanceSalaryApprovedRequest[$i]['name'],
                                    $advanceSalaryApprovedRequest[$i]['comments'],
                                    $advanceSalaryApprovedRequest[$i]['date_of_submit'],
                                    $advanceSalaryApprovedRequest[$i]['department_name'],
                                    $advanceSalaryApprovedRequest[$i]['company_name'],
                                    $advanceSalaryApprovedRequest[$i]['phone'],
                                )), null, 'A2', false, false);
                            }
                        });
            })->export('xls');
        }
    }
}
