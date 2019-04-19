<?php

namespace App\Http\Controllers\Company;

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
        $this->middleware('company');
    }

    public function communication(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => 'Communcation'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id; 
        $communicationobj = new Communication();
        $communicationreplyobj = new CommunicationReply();
        $cmpMails = $communicationobj->companyEmailsForCommunication($logedcompanyId);
        $cmpReplyMails = $communicationreplyobj->companyEmailsForCommunicationReply($logedcompanyId);
        
        $cmpMails = $cmpMails ? $cmpMails->toArray() : [];
        $cmpReplyMails = $cmpReplyMails ? $cmpReplyMails->toArray() : [];

        if (!empty($cmpMails)) 
        {
            foreach ($cmpMails as $key => $value) 
            {
                $value['employee_id'] == 0 ? $cmpMails[$key]['name'] = 'Admin' : '';   
            }    
        }
        
        // echo "<pre>"; print_r($cmpMails); exit();

        $data['cmpMails'] = array_merge($cmpMails,$cmpReplyMails);

        return view('company.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();

        if(isset($request->communication_id) && $request->communication_id != '' && $request->isMethod('get'))
        {
            if($request->communication_table == 'communication_reply')
            {
                $objCommunicationReply = new CommunicationReply();
                $result = $objCommunicationReply->companyEmailCommunicationReplyDetail('', $request->communication_id);
                $data['communication_id'] = $result->communication_id;
                // echo "<pre>"; print_r($result->toArray()); exit();
            }
            else
            {
                $objCommunication = new Communication();
                $result = $objCommunication->companyEmailCommunicationDetail('', $request->communication_id);
                $data['communication_id'] = $request->communication_id;
            }
            
            $data['employee_id'] = $result->employee_id;
            $data['employee_name'] = $result->name;
            $data['subject'] = $result->subject;
            $data['communication_table'] = $request->communication_table;
        }

        if ($request->isMethod('post')) {

            if(isset($request->communication_id) && $request->communication_id != '')
            {
                $objCommunicationReply = new CommunicationReply();
                $result = $objCommunicationReply->addNewCommunicationReply($request, $companyId->id);
            }
            else
            {
                $objCommunication = new Communication();
                $result = $objCommunication->addNewCommunication($request, $companyId->id);
            }

            // print_r($request->all());exit;
            
            if ($result) {

                //notification add
                $objNotification = new Notification();
                $communicationName="Communication a message is received.";
                $objEmployee = new Employee();
                $u_id=$objEmployee->getUseridById($request->input('emp_id'));
                $ret = $objNotification->addNotification($u_id,$communicationName);

                $return['status'] = 'success';
                $return['message'] = 'New Communication Email sent successfully.';
                $return['redirect'] = route('communication');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }

        $objEmployee = new Employee();
        $data['employeeList'] = $objEmployee->getEmployeeList($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js', 'jquery.form.min.js');
        $data['funinit'] = array('Communication.compose_mail()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => route("communication"),
                'Compose' => 'Compose'));

        return view('company.communication.compose', $data);
    }

    public function mailDetail(Request $request, $id)
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => route("communication"),
                'Communcation Detail' => 'Communcation Detail'));

        $empobj = new Employee();
        
        $userData = Auth::guard('company')->user();
       
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;

        if($request->communication_table == 'communication')
        {
            $communicationobj = new Communication();
            $data['cmpMailDetail'] = $communicationobj->companyEmailCommunicationDetail($logedcompanyId, $id);
        }
        else
        {
            $communicationreplyobj = new CommunicationReply();
            $data['cmpMailDetail'] = $communicationreplyobj->companyEmailCommunicationReplyDetail($logedcompanyId, $id);
        }   
        
        return view('company.communication.communication-detail', $data);
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
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => 'Communcation'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id; 
        $communicationobj = new Communication();
        $communicationreplyobj = new CommunicationReply();
        $cmpMails = $communicationobj->sendCompanyEmails($logedcompanyId);
        $cmpReplyMails = $communicationreplyobj->sendCompanyEmails($logedcompanyId);
        
        $cmpMails = $cmpMails ? $cmpMails->toArray() : [];
        $cmpReplyMails = $cmpReplyMails ? $cmpReplyMails->toArray() : [];

        $data['cmpMails'] = array_merge($cmpMails,$cmpReplyMails);

        return view('company.communication.send-communication', $data);
    }
}
