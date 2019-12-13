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
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;
use App\Model\PayrollSetting;
use App\Model\Notification;
use App\Model\NotificationMaster;

class PayrolesettingController extends Controller {

    public function __construct() {
         parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
        
        $id = Auth()->guard('company')->user()['id'];
        $companyId = Company::select('id')->where('user_id', $id)->first();
        $session = $request->session()->all();
        $items = Session::get('notificationdata');
        $userID = $session['logindata'][0]['id'];
        if ($request->isMethod('post')) {
            $objPayrollSetting = new PayrollSetting;
            $result= $objPayrollSetting->addpayrollSetting($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New greade created successfully.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('payroll-setting');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
                $return['jscode'] ='$(".submitbtn").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID);        
        Session::put('notificationdata', $items);

        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Payroll Setting List',
            'breadcrumb' => array(
            'Home' => route("company-dashboard"),
            'Payroll Setting List' => 'Payroll Setting List'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/payrollsetting.js');
        $data['funinit'] = array('Payrollsetting.init()');
        $data['css'] = array('');
        return view('company.payrollsetting.list', $data);
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        
        switch ($action) {
            case 'getdatatable':
                $objPayrollSetting = new PayrollSetting;
                $result= $objPayrollSetting->getdatatable();
                echo json_encode($result);
                break;
            
            case 'payrollsettingdelete':
                
                $objPayrollSetting = new PayrollSetting;
                $result= $objPayrollSetting->payrollsettingdelete($request);
                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Payroll Setting deleted successfully.';
                    $return['redirect'] = route('payroll-setting');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                exit;
                
        }
    }
}
