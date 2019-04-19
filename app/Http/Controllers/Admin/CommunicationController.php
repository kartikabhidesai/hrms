<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('admin');
    }

    public function communication(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Communcation' => 'Communcation'));

        
        $communicationobj = new Communication();
        $cmpMails = $communicationobj->companyEmailsForAdminCommunication();

        $cmpMails = $cmpMails ? $cmpMails->toArray() : [];

        $data['cmpMails'] = array_merge($cmpMails);

        return view('admin.communication.communication', $data);
    }

    public function compose(Request $request)
    {
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
                $result = $objCommunication->addNewCommunicationAdmin($request);
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

        $data['companyList'] = Company::select('id','company_name')->get();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js', 'jquery.form.min.js');
        $data['funinit'] = array('Communication.compose_mail()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Communcation' => url("admin/communication"),
                'Compose' => 'Compose'));

        return view('admin.communication.compose', $data);
    }

    public function mailDetail(Request $request, $id)
    {        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Communcation' => url("admin/communication"),
                'Communcation Detail' => 'Communcation Detail'));

        if($request->communication_table == 'communication')
        {
            $communicationobj = new Communication();
            $data['cmpMailDetail'] = $communicationobj->adminEmailCommunicationDetail($id);
        }
        else
        {
            $communicationreplyobj = new CommunicationReply();
            $data['cmpMailDetail'] = $communicationreplyobj->companyEmailCommunicationReplyDetail($logedcompanyId, $id);
        }   
        
        return view('admin.communication.communication-detail', $data);
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
        $data['js'] = array('admin/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Communcation' => 'Communcation'));

        $communicationobj = new Communication();
        $cmpMails = $communicationobj->sendAdminEmails();
        $cmpMails = $cmpMails ? $cmpMails->toArray() : [];

        $data['cmpMails'] = array_merge($cmpMails);

        return view('admin.communication.send-communication', $data);
    }
}
