<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Communication;
use App\Model\CommunicationReply;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Session;
use Auth;
use Response;
use App\Model\Users;
use App\Model\UserNotificationType;
use App\Model\SendSMS;

class CommunicationController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function communication(Request $request) 
    {
        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => 'Email'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($logedcompanyId);
        
        $communicationobj = new Communication();
        $cmpMails = $communicationobj->companyEmailsForCommunication($logedcompanyId);
        $data['cmpMails'] = $cmpMails ? $cmpMails->toArray() : [];
        return view('company.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        // $userid = $this->loginUser->id;
        $userid = Auth::guard('company')->user();
        $companyId = Company::select('id')->where('user_id', $userid->id)->first();
        // $getAuthCompanyId = Company::where('email', $userData->email)->first();
        // $logedcompanyId = $getAuthCompanyId->id;
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($companyId->id);
        
        if(isset($request->communication_id) && $request->communication_id != '' && $request->isMethod('get'))
        {         
            $objCommunication = new Communication();
            $data['cmpMailDetail'] = $objCommunication->companyEmailCommunicationDetail($request->communication_id);
            $data['communication_id'] = $request->communication_id;
        }

        if ($request->isMethod('post')) 
        {
//            print_r($request->input('emp_id'));exit;
            $objCommunication = new Communication();
            $result = $objCommunication->addNewCommunicationCmp($request, $companyId->id);

            if ($result) {
                $notificationMasterId=5;
                $objNotificationMaster = new NotificationMaster();
//                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus(,$notificationMasterId);
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($userid->id,$notificationMasterId);
                    
                    if($NotificationUserStatus->status==1)
                    {
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
       
                        if($result[0]['status'] == 1){
//                            SMS  Notification
                            $notificationMasterId=5;
                            $msg= "Communication a message is received.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaation($notificationMasterId,$request->input('emp_id'),$msg);
                        }
                        
                        if($result[1]['status'] == 1){
//                            EMAIL Notification
                            $notificationMasterId=5;
                            $msg= "Communication a message is received.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotification($notificationMasterId,$request->input('emp_id'),$msg);
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                        //notification add
                            $objNotification = new Notification();
                            $communicationName="Communication a message is received.";
                            $objEmployee = new Employee();
                            $u_id=$objEmployee->getUseridById($request->input('emp_id'));
                            $route_url="emp-communication";
                            $ret = $objNotification->addNotification($u_id,$communicationName,$route_url,$notificationMasterId);
                        }
                    }

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
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => route("communication"),
                'Compose' => 'Compose'));

        return view('company.communication.compose', $data);
    }

    public function mailDetail(Request $request, $id)
    {
        $session = $request->session()->all();
        $objMakeread = new Communication();
        $makeRead = $objMakeread->Makeread($id);
        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($logedcompanyId);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => route("communication"),
                'Email Detail' => 'Email Detail'));
        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $communicationobj = new Communication();
        $data['id']=$id;
        $data['cmpMailDetail'] = $communicationobj->companyEmailCommunicationDetail($id);
        $data['unread'] = $communicationobj->unreadEmailsForCommunication($logedcompanyId);
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
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => 'Email'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id; 
        $communicationobj = new Communication();
        $cmpMails = $communicationobj->sendCompanyEmails($logedcompanyId);
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($logedcompanyId);
        $data['cmpMails'] = $cmpMails ? $cmpMails->toArray() : [];
        return view('company.communication.send-communication', $data);
    }

    public function sendMailDetail(Request $request, $id)
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => route("communication"),
                'Email Detail' => 'Email Detail'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $communicationobj = new Communication();
        $data['cmpMailDetail'] = $communicationobj->companySendEmailCommunicationDetail($id);
        $data['unread'] = $communicationobj->unreadEmailsForCommunication($logedcompanyId);
        return view('company.communication.send-communication-detail', $data);
    }
    
    public function trashMail(Request $request){
        $objTrashMail = new Communication();
        $result= $objTrashMail->trashMail($request['data']);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Communication Email deleted successfully.';
                $return['redirect'] = route('communication');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
    }
    
    public function trashMailList(Request $request){
        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.trash()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => 'Email'));

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($logedcompanyId);
        
        $communicationobj = new Communication();
        $cmpMails = $communicationobj->companyTrashEmailsForCommunication($logedcompanyId);
        $data['cmpMails'] = $cmpMails ? $cmpMails->toArray() : [];
        
        return view('company.communication.communicationTrash', $data);
    }
    
    public function mailDetailTrash(Request $request,$id){
        $session = $request->session()->all();
        $objMakeread = new Communication();
        $makeRead = $objMakeread->Makeread($id);
        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($logedcompanyId);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => route("communication"),
                'Email Detail' => 'Email Detail'));
        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $communicationobj = new Communication();
        $data['id']=$id;
        $data['cmpMailDetail'] = $communicationobj->companyEmailCommunicationDetail($id);
        $data['unread'] = $communicationobj->unreadEmailsForCommunication($logedcompanyId);
        return view('company.communication.communication-detail-trash', $data);
    }
    
    public function forword(Request $request,$id){
        

        $session = $request->session()->all();
        $userid = Auth::guard('company')->user();
        $companyId = Company::select('id')->where('user_id', $userid->id)->first();
        
        if ($request->isMethod('post')) 
        {
//            print_r($request->input('emp_id'));exit;
            $objCommunication = new Communication();
            $result = $objCommunication->addNewCommunicationCmpForward($request, $companyId->id);

            if ($result) {
                $notificationMasterId=5;
                $objNotificationMaster = new NotificationMaster();
//                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus(,$notificationMasterId);
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatusNew($userid->id,$notificationMasterId);
                    
                    if($NotificationUserStatus->status==1)
                    {
                        $objUserNotificationType = new UserNotificationType();
                        $result = $objUserNotificationType->checkMessage($NotificationUserStatus->id);
       
                        if($result[0]['status'] == 1){
//                            SMS  Notification
                            $notificationMasterId=5;
                            $msg= "Communication a message is received.";
                            $objSendSms = new SendSMS();
                            $sendSMS = $objSendSms->sendSmsNotificaation($notificationMasterId,$request->input('emp_id'),$msg);
                        }
                        
                        if($result[1]['status'] == 1){
//                            EMAIL Notification
                            $notificationMasterId=5;
                            $msg= "Communication a message is received.";
                            $objSendEmail = new Users();
                            $sendEmail = $objSendEmail->sendEmailNotification($notificationMasterId,$request->input('emp_id'),$msg);
                        }
                        
                        if($result[2]['status'] == 1){
//                            chat Notification
                        }
                        
                        if($result[3]['status'] == 1){
                        //notification add
                            $objNotification = new Notification();
                            $communicationName="Communication a message is received.";
                            $objEmployee = new Employee();
                            $u_id=$objEmployee->getUseridById($request->input('emp_id'));
                            $route_url="emp-communication";
                            $ret = $objNotification->addNotification($u_id,$communicationName,$route_url,$notificationMasterId);
                        }
                    }

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
        $unreadobj = new Communication();
        $data['unread'] = $unreadobj->unreadEmailsForCommunication($companyId->id);
        $session = $request->session()->all();
        $userid = Auth::guard('company')->user();
        $companyId = Company::select('id')->where('user_id', $userid->id)->first();
        
        $objCommunicationDetails= new Communication();
        $data['details'] = $objCommunicationDetails->getDetails($id);
        
        $objEmployee = new Employee();
        $data['employeeList'] = $objEmployee->getEmployeeList($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js', 'jquery.form.min.js');
        $data['funinit'] = array('Communication.forward()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Email' => route("communication"),
                'Forword' => 'Forword'));

        return view('company.communication.forword', $data);
    }
}
