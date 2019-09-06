<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Users;
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
        $data['unread'] = $communicationobj->unreadEmailsForCommunicationAdmin();
        $data['cmpMails'] = $cmpMails ? $cmpMails->toArray() : [];

        return view('admin.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        if(isset($request->communication_id) && $request->communication_id != '' && $request->isMethod('get'))
        {
            
            $objCommunication = new Communication();
            $result = $objCommunication->adminEmailCommunicationDetail($request->communication_id);
            $data['communication_id'] = $request->communication_id;
            $data['adminComDetail'] = $result;
        }

        if ($request->isMethod('post')) {
           $objUSer = new Users();
           $userId=$objUSer->getUserId($request->input('cmp_id'));
          
           
            $objCommunication = new Communication();
            $mailId = $objCommunication->addNewCommunicationAdmin($request);
            if ($mailId) {
                //notification add
                $objNotification = new Notification();
                $communicationName="Communication a message is received.";
                $objEmployee = new Employee();
                $u_id=$objEmployee->getUseridById($request->input('emp_id'));
                $ret = $objNotification->addNotification($userId,$communicationName,'mail-detail/'.$mailId,11);
                $return['status'] = 'success';
                $return['message'] = 'New Communication Email sent successfully.';
                $return['redirect'] = route('admin-compose');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            
            echo json_encode($return);
            exit;
        }
        
        $objCommunication = new Communication();
        $data['unread'] = $objCommunication->unreadEmailsForCommunicationAdmin();
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

        $communicationobj = new Communication();
        $data['unread'] = $communicationobj->unreadEmailsForCommunicationAdmin();
        $data['cmpMailDetail'] = $communicationobj->adminEmailCommunicationDetail($id);
        
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
        $data['unread'] = $communicationobj->unreadEmailsForCommunicationAdmin();

        return view('admin.communication.send-communication', $data);
    }

    public function sendMailDetail(Request $request, $id)
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

        $communicationobj = new Communication();
        $data['unread'] = $communicationobj->unreadEmailsForCommunicationAdmin();
        $data['cmpMailDetail'] = $communicationobj->adminEmailCommunicationDetail($id);
        
        return view('admin.communication.send-communication-detail', $data);
    }
}
