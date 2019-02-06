<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;

class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        $this->middleware('employee');
    }

    public function manageTimeChangeRequestList() {
    	$id = Auth()->guard('employee')->user()['id'];
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
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/leave.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Leave.init()');
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
