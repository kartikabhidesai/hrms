<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Announcement;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }

    public function dashboard(Request $request) {

        //$logged_in_user=Auth::guard('employee')->user()->id;
        $session = $request->session()->all();
        $data['login_user'] = $session['logindata'][0];
        $logged_in_user_id = $session['logindata'][0]['id'];
        $logged_in_user_company_id = Employee::select('company_id')->where('user_id', $logged_in_user_id)->first();

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/dashbord.js');
        $data['funinit'] = array('Dashboard.init()');
        $data['css'] = array('');
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Employee',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Announcement' => 'Announcement'));
        return view('employee.dashboard', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                
                $session = $request->session()->all();
                $logged_in_user_id = $session['logindata'][0]['id'];
                $logged_in_user_company_id = Employee::select('company_id')->where('user_id', $logged_in_user_id)->first();
                $objAnnounmnt = new Announcement();

                $rs = $objAnnounmnt->getAnnouncementList($request,$logged_in_user_company_id);
                echo json_encode($rs);
                break;
           
        }
    }

}
