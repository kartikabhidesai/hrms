<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\SendSMS;
use App\Model\Department;

class SendSMSController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function smsList(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/send_sms.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send SMS',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'SMS List' => 'SMS List'));
        return view('company.send-sms.sms_list', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objSMS = new SendSMS();
                $userid = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userid)->first();
                $smsList = $objSMS->getSMSDatatable($request, $companyId->id);
                echo json_encode($smsList);
                break;
            case 'getEmployee':
                $empId = $request->input('data');

                $userid = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userid)->first();

                $objEmployee = new Employee();
                $employee = $objEmployee->getEmployeeByDept($empId,$companyId->id);
                // print_r($employee);exit;
                echo json_encode($employee);
                break;
        }
    }

    public function newSMS(Request $request) 
    {
    	$session = $request->session()->all();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $data['departments'] = Department::where('company_id', $companyId['id'])->get();

        if($request->isMethod('post')) {
            $newSMS = new SendSMS();
            $result = $newSMS->sendNewSMS($request, $companyId->id);

            if ($result) {
                $newSMS = new SendSMS();
                $resultApi = $newSMS->sendNewSMSApi($request, $companyId->id);
                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'New SMS sent successfully.';
                    $return['redirect'] = route('sms-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something went wrong!';
                }
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }

            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/send_sms.js', 'jquery.form.min.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send New SMS',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'SMS List' => route("admin-sms-list"),
                'Send New SMS' => 'Send New SMS'));
        return view('company.send-sms.send_new_sms', $data);
    }

}
