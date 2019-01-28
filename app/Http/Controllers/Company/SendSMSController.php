<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\SendSMS;

class SendSMSController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function smsList(Request $request) 
    {
        $session = $request->session()->all();
        /*$userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();*/
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/send_sms.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send SMS',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Send SMS' => 'Send SMS'));
        return view('company.send-sms.sms_list', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objSMS = new SendSMS();
                $userid = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userid)->first();
                $smsList = $objSMS->getSMSDatatable($request, $companyId->id);
                echo json_encode($smsList);
                break;
        }
    }

    public function newSMS(Request $request) 
    {
    	$session = $request->session()->all();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();

        if($request->isMethod('post')) {
        	dd('x');
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/send_sms.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send New SMS',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Send New SMS' => 'Send New SMS'));
        return view('company.send-sms.send_new_sms', $data);
    }
}
