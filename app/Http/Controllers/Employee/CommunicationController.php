<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Communication;
use App\Model\CommunicationReply;
use App\Model\Notification;
use Auth;
use Response;

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
        $communicationreplyobj = new CommunicationReply();
        $userData = Auth::guard('employee')->user();
        $getAuthEmpId = Employee::where('email', $userData->email)->first();
        $logedEmpId = $getAuthEmpId->id; 
        $empMails = $communicationobj->employeeEmailsForCommunication($logedEmpId);
        $empReplyMails = $communicationreplyobj->employeeEmailsForCommunicationReply($logedEmpId);

        $empMails = $empMails ? $empMails->toArray() : [];
        $empReplyMails = $empReplyMails ? $empReplyMails->toArray() : [];

        $data['empMails'] = array_merge($empMails,$empReplyMails);
        
        return view('employee.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        $userid = $this->loginUser->id;
        $empId = Employee::select('id', 'company_id')->where('user_id', $userid)->first();

        if(isset($request->communication_id) && $request->communication_id != '' && $request->isMethod('get'))
        {
            $data['communication_id'] = $request->communication_id;
            $objCommunication = new Communication();
            $getSubject = $objCommunication->getComminucationDataEmp($request->communication_id);
            $data['subject'] = $getSubject->subject;
        }

        if ($request->isMethod('post')) {

            if(isset($request->communication_id) && $request->communication_id != '')
            {
                $objCommunication = new CommunicationReply();
                $result = $objCommunication->addNewCommunicationReplyEmp($request, $empId->company_id, $empId->id);
            }
            else
            {
                $objCommunication = new Communication();
                $result = $objCommunication->addNewCommunicationEmp($request, $empId->company_id, $empId->id);
            }

            if ($result) {
                
                     //notification add
                    $objNotification = new Notification();
                    $communicationName="Communication a message is received.";
                    $objCompany = new Company();
                    $u_id=$objCompany->getUseridById($empId->company_id);
                    $ret = $objNotification->addNotification($u_id,$communicationName);

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
        $data['funinit'] = array('Communication.compose_mail()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Communcation' => route("emp-communication"),
                'Compose' => 'Compose'));

        // echo "<pre>"; print_r($data); exit();
        return view('employee.communication.compose', $data);
    }

    public function empCommunicationDetail(Request $request, $id)
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
                'Communcation' => route("emp-communication"),
                'Communcation Detail' => 'Communcation Detail'));

        $empobj = new Employee();
        
        $userData = Auth::guard('employee')->user();
       
        $getAuthEmployeeId = Employee::where('email', $userData->email)->first();
        $logedEmpId = $getAuthEmployeeId->id;

        if($request->communication_table == 'communication')
        {
            $communicationobj = new Communication();
            $data['empMailDetail'] = $communicationobj->employeeEmailCommunicationDetail($logedEmpId, $id);
        }
        else
        {
            $communicationreplyobj = new CommunicationReply();
            $data['empMailDetail'] = $communicationreplyobj->employeeEmailCommunicationReplyDetail($logedEmpId, $id);
        }
        
        return view('employee.communication.communication-detail', $data);
    }

    public function downloadAttachment(Request $request, $fileName)
    {
        $file_path = public_path() .'/uploads/communication/'. $fileName;
        if (file_exists($file_path))
        {
            // Download File
            return Response::download($file_path, $fileName, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function sendMail(Request $request)
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
        $communicationreplyobj = new CommunicationReply();
        $userData = Auth::guard('employee')->user();
        $getAuthEmpId = Employee::where('email', $userData->email)->first();
        $logedEmpId = $getAuthEmpId->id; 
        $empMails = $communicationobj->sendEmployeeEmails($logedEmpId);
        $empReplyMails = $communicationreplyobj->sendEmployeeEmails($logedEmpId);
        
        $empMails = $empMails ? $empMails->toArray() : [];
        $empReplyMails = $empReplyMails ? $empReplyMails->toArray() : [];

        $data['empMails'] = array_merge($empMails,$empReplyMails);

        return view('employee.communication.send-communication', $data);
    }
}
