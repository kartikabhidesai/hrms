<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Auth;
use Route;
class CompanyManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function timeChangeRequest(Request $request)
    {
    	$session = $request->session()->all();
        $logindata = $session['logindata'][0];
        
        $userid = $logindata['id'];
      
        $companyId = Employee::select('company_id')->where('user_id', $userid)->get();
        $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
        $company_Id = $companyId[0]['company_id'];
        
        $objManageList = new ManageTimeChangeRequest();
        $data['arrRejectCount'] = $objManageList->getStatusCount($company_Id,'reject');
        $data['arrApproveCount'] = $objManageList->getStatusCount($company_Id,'approve');
        $data['arrRemovedCount'] = $objManageList->getStatusCount($company_Id,'removed');
        $data['arrNewCount'] = $objManageList->getStatusCount($company_Id,'new');
        $data['arrModifiedCount'] = $objManageList->getStatusCount($company_Id,'modified');
        $data['arrCanclledCount'] = $objManageList->getStatusCount($company_Id,'canclled');
        // print_r($arrRejectCount);exit;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/companytimeChangeRequest.js');
        $data['funinit'] = array('TimeChangeRequest.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Manage Time Change Request' => 'Manage Time Change Request'));
        return view('employee.companymanage-time-change-request.request-list', $data);
    }
    
    public function ajaxaction(Request $request){
        
        $action=$request->input('action');
        switch ($action)
        {
                case 'getdatatable':
                    $session = $request->session()->all();
                    $logindata = $session['logindata'][0];

                    $userid = $logindata['id'];

                    $companyId = Employee::select('company_id')->where('user_id', $userid)->get();
                    $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
                    $company_Id = $companyId[0]['company_id'];
//                    $companyId = Company::select('id')->where('user_id', $userID->id)->first();
                    $objManageList=new ManageTimeChangeRequest();
                    $datalist=$objManageList->companygetManageTimeChangeList($company_Id);
                    echo json_encode($datalist);
                    break;
                
                case 'approveRequest':
                    
                    $session = $request->session()->all();
                    $logindata = $session['logindata'][0];
                    $userid = $logindata['id'];
                    $companyId = Employee::select('company_id')->where('user_id', $userid)->get();
                    $userID = Company::select('user_id')->where('id', $companyId[0]['company_id'])->get();
                    $company_Id = $companyId[0]['company_id'];
                    
                    $id=$request->input('data')['id'];
                    
                    $objManageList=new ManageTimeChangeRequest();
                    $approveRequest=$objManageList->approveRequest($id);
                    if ($approveRequest) {
                        
                        $notificationMasterId=9;
                        $objNotificationMaster = new NotificationMaster();
                        $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($company_Id,$notificationMasterId);
                        
                        if($NotificationUserStatus==1)
                        {                  
                            $seleryRequestName="Company time change request approved.";
                            $u_id=$objManageList->getUseridByManageTimeChangeRequestId($id);
                            $route_url="manage-time-change-request";
                            $objNotification = new Notification();
                            $ret = $objNotification->addNotification($company_Id,$seleryRequestName,$route_url,$notificationMasterId);
                        }
                        $return['status'] = 'success';
                        $return['message'] = 'Time chnage request approved';
                        $return['redirect'] = route('time-change-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
                    
               case 'disapproveRequest':
                    $userID = $this->loginUser;
                    $id=$request->input('data')['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $disapproveRequest=$objManageList->disapproveRequest($id);
                    if ($disapproveRequest) {

                        $notificationMasterId=9;
                        $objNotificationMaster = new NotificationMaster();
                        $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($company_Id,$notificationMasterId);
                        
                        if($NotificationUserStatus==1)
                        {
                                            
                            $seleryRequestName="Company time change request rejected.";
                            $u_id=$objManageList->getUseridByManageTimeChangeRequestId($id);
                            $objNotification = new Notification();
                            $route_url="manage-time-change-request";
                            $ret = $objNotification->addNotification($u_id,$seleryRequestName,$route_url);
                        }

                        $return['status'] = 'success';
                        $return['message'] = 'Time chnage request rejected';
                        $return['redirect'] = route('time-change-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;  

                case 'changeStatus':
                    $userID = $this->loginUser;
                    $objManageList=new ManageTimeChangeRequest();
                    $disapproveRequest=$objManageList->editStatus($request->input('data'));
                    if ($disapproveRequest) {

                        $notificationMasterId=9;
                        $objNotificationMaster = new NotificationMaster();
                        $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($userID->id,$notificationMasterId);
                        
                        if($NotificationUserStatus==1)
                        {

                            //notification add  
                            $postData=$request->input('data');
                            $status = $postData['status']; 
                            $employeeArr = $postData['arrEmp'];
                            foreach ($employeeArr as $key => $value) {  
                                $seleryRequestName="Company time change request ".$status."ed.";
                                $u_id=$objManageList->getUseridByManageTimeChangeRequestId($value);
                                $route_url="manage-time-change-request";
                                $objNotification = new Notification();
                                $ret = $objNotification->addNotification($u_id,$seleryRequestName,$route_url,$notificationMasterId);
                            }
                        }

                        $return['status'] = 'success';
                        $return['message'] = 'Status Change successfully.';
                        $return['redirect'] = route('time-change-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
                    
        }
            
                
    }
}
