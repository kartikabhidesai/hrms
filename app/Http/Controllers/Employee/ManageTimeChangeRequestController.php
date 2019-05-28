<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use App\Model\AttendanceHistory;
use App\Model\TypeOfRequest;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Session;
use Auth;
use Config;
use Route;
class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        $this->middleware('employee');
    }

    public function manageTimeChangeRequestList() {

        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);
        
    	$id = Auth()->guard('employee')->user()['id'];
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard")));
        $timeRequestObj = new ManageTimeChangeRequest;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/newTimeChangeRequest.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Timechange.list()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');

        return view('employee.manage-time-change-request.request-list', $data);
    }

    public function newTimeChangeRequest(Request $request)
    {   

        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        $objEmployee=new Employee();
        $empdetails=$objEmployee->getEmploydetails($logindata['id']);

        $objTypeOfRequest = new TypeOfRequest();
        $data['type_of_request']= $objTypeOfRequest->getTypeOfRequestV2($empdetails[0]->emp_id);
        $data['depat_name']=$empdetails[0]->department_name;
//        $data['dep_id']=$empdetails[0]->dep_id;
        $data['id']=$empdetails[0]->id;
        $data['company_id']=$empdetails[0]->company_id;
        $data['emp_id']=$empdetails[0]->emp_id;
        $data['name']=$logindata['name'];
        
        // $data['type_of_request'] = Config::get('constants.type_of_request');
        if ($request->isMethod('post')) {
           $objTimeManagement=new ManageTimeChangeRequest();
           $result=$objTimeManagement->addnewTimeManage($request,$logindata);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New Manage Time Change Request created successfully.';
                $return['redirect'] = route('manage-time-change-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/newTimeChangeRequest.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Timechange.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'New Time Change Request',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Manage Time Change Request' => route("manage-time-change-request"),
                'New Request'=>'New Request'));
        return view('employee.manage-time-change-request.new-request', $data);
    }
    
    public function deleteLeave($postData) {
        if ($postData) {
            $deleteAttendanceHistory = AttendanceHistory::where('time_change_request_id', $postData['id'])->delete();
            $result = ManageTimeChangeRequest::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Manage Time Change Request delete successfully.';
                 $return['redirect'] = route('manage-time-change-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
    
    
    
    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        
        switch ($action) {
            
            case 'getdatatable':
                $id = Auth()->guard('employee')->user()['id'];
                $objEmploye=new Employee();
                $employeid=$objEmploye->getUserid($id);
                $objManageList=new ManageTimeChangeRequest();
                $datalist=$objManageList->getManageTimeChangeList($employeid);
                echo json_encode($datalist);
                break;
            
            case 'deleteLeave':
                $result = $this->deleteLeave($request->input('data'));
                break;
        }
    }
}
