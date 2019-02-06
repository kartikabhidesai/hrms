<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function timeChangeRequest(Request $request)
    {
    	$session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/employee.js');
        $data['funinit'] = array('Employee.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Manage Time Change Request' => 'Manage Time Change Request'));
        return view('company.manage-time-change-request.request-list', $data);
    }
}
