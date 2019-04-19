<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('admin');
    }

    public function smsList(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/send_sms.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send SMS',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'SMS List' => 'SMS List'));
        return view('admin.send-sms.sms_list', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objSMS = new SendSMS();
                $userid = $this->loginUser->id;
                $smsList = $objSMS->getSMSDatatable($request);
                echo json_encode($smsList);
                break;
            case 'getDepartment':
                if($request->data == 'All')
                {
                    $departments = Department::pluck('department_name', 'id')->toArray();
                }
                else
                {
                    $departments = Department::where('company_id',$request->data)->pluck('department_name', 'id')->toArray();
                }
                echo json_encode($departments);
                break;
            case 'getEmployee':
                $objEmployee = new Employee();
                $employee = $objEmployee->getEmployeeByDept($request->dept_id,$request->company_id);
                echo json_encode($employee);
                break;
        }
    }

    public function newSMS(Request $request) 
    {
    	$session = $request->session()->all();
        $userid = $this->loginUser->id;
        $data['companies'] = Company::select('comapnies.*')->get();
        // $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        // $data['departments'] = Department::where('company_id', $companyId['id'])->get();

        if($request->isMethod('post')) {
            // echo "<pre>"; print_r($request->toArray()); exit();
            $newSMS = new SendSMS();
            $result = $newSMS->sendNewSMS($request);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New SMS sent successfully.';
                $return['redirect'] = url('').'/admin/sms-list';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }

            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/send_sms.js', 'jquery.form.min.js');
        $data['funinit'] = array('SendSMS.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Send New SMS',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'SMS List' => url("admin/sms-list"),
                'Send New SMS' => 'Send New SMS'));
        return view('admin.send-sms.send_new_sms', $data);
    }

}
