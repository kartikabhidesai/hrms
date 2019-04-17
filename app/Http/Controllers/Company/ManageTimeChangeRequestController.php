<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use App\Model\Notification;
use Auth;
use Route;
class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function timeChangeRequest(Request $request)
    {
    	$session = $request->session()->all();

        $userID = $this->loginUser;
        $companyId = Company::select('id')->where('user_id', $userID->id)->first();
        $objManageList = new ManageTimeChangeRequest();
        $data['arrRejectCount'] = $objManageList->getStatusCount($companyId->id,'reject');
        $data['arrApproveCount'] = $objManageList->getStatusCount($companyId->id,'approve');
        $data['arrRemovedCount'] = $objManageList->getStatusCount($companyId->id,'removed');
        $data['arrNewCount'] = $objManageList->getStatusCount($companyId->id,'new');
        $data['arrModifiedCount'] = $objManageList->getStatusCount($companyId->id,'modified');
        $data['arrCanclledCount'] = $objManageList->getStatusCount($companyId->id,'canclled');
        // print_r($arrRejectCount);exit;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/timeChangeRequest.js');
        $data['funinit'] = array('TimeChangeRequest.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Manage Time Change Request' => 'Manage Time Change Request'));
        return view('company.manage-time-change-request.request-list', $data);
    }
    
    public function ajaxaction(Request $request){
        
        $action=$request->input('action');
        switch ($action)
        {
                case 'getdatatable':
                    $userID = $this->loginUser;
                    $companyId = Company::select('id')->where('user_id', $userID->id)->first();
                    $objManageList=new ManageTimeChangeRequest();
                    $datalist=$objManageList->companygetManageTimeChangeList($companyId->id);
                    echo json_encode($datalist);
                    break;
                
                case 'approveRequest':
                    $id=$request->input('data')['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $approveRequest=$objManageList->approveRequest($id);
                    if ($approveRequest) {

                        //notification add                        
                        $seleryRequestName="Company time change request approved.";
                        $u_id=$objManageList->getUseridByManageTimeChangeRequestId($id);
                        $objNotification = new Notification();
                        $ret = $objNotification->addNotification($u_id,$seleryRequestName);
                        
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
                    $id=$request->input('data')['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $disapproveRequest=$objManageList->disapproveRequest($id);
                    if ($disapproveRequest) {

                        //notification add                        
                        $seleryRequestName="Company time change request rejected.";
                        $u_id=$objManageList->getUseridByManageTimeChangeRequestId($id);
                        $objNotification = new Notification();
                        $ret = $objNotification->addNotification($u_id,$seleryRequestName);
                        
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
                    
                    $objManageList=new ManageTimeChangeRequest();
                    $disapproveRequest=$objManageList->editStatus($request->input('data'));
                    if ($disapproveRequest) {

                        //notification add  
                        $postData=$request->input('data');
                        $status = $postData['status']; 
                        $employeeArr = $postData['arrEmp'];
                        foreach ($employeeArr as $key => $value) {  
                            $seleryRequestName="Company time change request ".$status."ed.";
                            $u_id=$objManageList->getUseridByManageTimeChangeRequestId($value);
                            $objNotification = new Notification();
                            $ret = $objNotification->addNotification($u_id,$seleryRequestName);
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
