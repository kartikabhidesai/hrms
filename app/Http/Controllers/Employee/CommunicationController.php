<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Communication;
use Auth;

class CommunicationController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('employee');
    }

    public function communication(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Communcation' => 'Communcation'));

        $communicationobj = new Communication();
        $userData = Auth::guard('employee')->user();
        $getAuthEmpId = Employee::where('email', $userData->email)->first();
        $logedEmpId = $getAuthEmpId->id; 
        $data['empMails'] = $communicationobj->employeeEmailsForCommunication($logedEmpId);
        
        return view('employee.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        $userid = $this->loginUser->id;
        $empId = Employee::select('id', 'company_id')->where('user_id', $userid)->first();

        if ($request->isMethod('post')) {
            // print_r($request->all());exit;
            $objCommunication = new Communication();
            $result = $objCommunication->addNewCommunicationEmp($request, $empId->company_id, $empId->id);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New Communication Email sent successfully.';
                $return['redirect'] = route('emp-communication');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js', 'jquery.form.min.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Communcation' => 'Communcation',
                'Compose' => 'Compose'));

        return view('employee.communication.compose', $data);
    }
}
