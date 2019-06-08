<?php

namespace App\Http\Controllers\Employee;

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

class CommunicationController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('employee');
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
        $empMails = $communicationobj->employeeEmailsForCommunication($logedEmpId);

        $data['empMails'] = $empMails ? $empMails->toArray() : [];

        return view('employee.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        $userid = $this->loginUser->id;
        $empId = Employee::select('id', 'company_id')->where('user_id', $userid)->first();

        $companyEmployees = Employee::select('id','name')->where('company_id',$empId->company_id)->get();

        if(isset($request->communication_id) && $request->communication_id != '' && $request->isMethod('get'))
        {
            $data['communication_id'] = $request->communication_id;
            $objCommunication = new Communication();
            $data['CommunicationData'] = $objCommunication->getComminucationDataEmp($request->communication_id);
        }
        if ($request->isMethod('post')) {
            
            $objCommunication = new Communication();                
            $result = $objCommunication->addNewCommunication($request, $empId->company_id, $empId->id);

            if ($result) {

                    $objCompany = new Company();
                    $company_id=$objCompany->getUseridById($empId->company_id);

                    $notificationMasterId=11;
                    $objNotificationMaster = new NotificationMaster();
                    $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($company_id,$notificationMasterId);
                    
                    if($NotificationUserStatus==1)
                    {
                        //notification add
                        $objNotification = new Notification();
                        $communicationName="Communication a message is received.";
                        
                        // $u_id=$objCompany->getUseridById($empId->company_id);
                        $route_url="communication";
                        $ret = $objNotification->addNotification($company_id,$communicationName,$route_url,$notificationMasterId);
                    }

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

        $data['companyEmployees'] = $companyEmployees;
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
        
        $communicationobj = new Communication();
        $data['empMailDetail'] = $communicationobj->employeeEmailCommunicationDetail($id);

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
        $userData = Auth::guard('employee')->user();
        $getAuthEmpId = Employee::where('email', $userData->email)->first();
        $logedEmpId = $getAuthEmpId->id; 
        $empMails = $communicationobj->sendEmployeeEmails($logedEmpId);
        $empMails = $empMails ? $empMails->toArray() : [];
        $data['empMails'] = $empMails;

        return view('employee.communication.send-communication', $data);
    }
}
