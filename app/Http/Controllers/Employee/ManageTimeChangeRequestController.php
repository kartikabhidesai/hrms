<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use Auth;
use Route;
class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        $this->middleware('employee');
    }

    public function manageTimeChangeRequestList() {
    	$id = Auth()->guard('employee')->user()['id'];
//        $objEmploye=new Employee();
//        $employeid=$objEmploye->getUserid($id);
//        $objManageList=new ManageTimeChangeRequest();
//        $data['list']=$objManageList->getManageTimeChangeList($employeid);
//        
        $data['detail'] = $this->loginUser;
        
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard")));
        $timeRequestObj = new ManageTimeChangeRequest;

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/manage_time_change_request.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('ManageTimeChangeRequest.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');

        return view('employee.manage-time-change-request.request-list', $data);
    }

    public function newTimeChangeRequest(Request $request)
    {   
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
//        print_r($logindata);die();
        $objEmployee=new Employee();
        $empdetails=$objEmployee->getEmploydetails($logindata['id']);
        $data['depat_name']=$empdetails[0]->department_name;
        $data['id']=$empdetails[0]->id;
        $data['company_id']=$empdetails[0]->company_id;
        $data['emp_id']=$empdetails[0]->id;
        $data['name']=$logindata['name'];
        
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
}
