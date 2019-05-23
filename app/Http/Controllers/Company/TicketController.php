<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Ticket;
use App\Model\TicketComment;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use App\Model\Designation;
use App\Model\NonWorkingDate;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Session;
use Config;
use Auth;
use Route;
class TicketController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request)
    {
        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);

        $data['priority'] = "";
        $data['status'] = "";
        
        if($request->method('get')){
            $data['priority'] = $request->input('priority');
            $data['status'] = $request->input('status');
        }

        
        $companyId = Company::select('id')->where('user_id', $userID->id)->first();
        $objTicketList = new Ticket();

        /*Don't remove this code*/
        /*$data['arrNewCount'] = $objTicketList->getNewTaskCount($companyId->id, 'new');
        $data['arrInprogressCount'] = $objTicketList->getInprogressTaskCount($companyId->id, 'inprogress');
        $data['arrCompletedCount'] = $objTicketList->getCompletedTaskCount($companyId->id, 'completed');*/
        $data['arrNewCount'] = 0;
        $data['arrInprogressCount'] = 0;
        $data['arrCompletedCount'] = 0;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket.js');
        $data['funinit'] = array('Ticket.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Ticket List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Tickets' => 'Tickets'));

        return view('company.ticket.ticket-list', $data);
    }
    
    public function add(Request $request){
        $session = $request->session()->all();
        $objEmployee = new Employee();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $employee_list = $objEmployee->getEmployeeList($companyId->id);

        if ($request->isMethod('post')) {
            $objNonWorkingDate = new NonWorkingDate();
            $resultNonWorkingDate = $objNonWorkingDate->getCompanyNonWorkingDateArrayList($companyId->id);
            // print_r($resultNonWorkingDate);
            //  $dateaa=date('Y-m-d', strtotime($request->input('due_date')));
            // exit;
            
            if(in_array(date('Y-m-d',strtotime($request->input('due_date'))), $resultNonWorkingDate)) {
                $return['status'] = 'error';
                $return['message'] = $request->input('due_date'). ' is Non Working Date';
            }else{
                $objTicket = new Ticket();
                $result = $objTicket->saveTicket($request);
                if($result) {

                    $notificationMasterId=8;
                    $objNotificationMaster = new NotificationMaster();
                    $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($userid,$notificationMasterId);
                    
                    if($NotificationUserStatus==1)
                    {
                        //notification add
                        $objNotification = new Notification();
                        $ticketName=$request->input('subject')." is a new ticket.";
                        $objEmployee = new Employee();
                        $u_id=$objEmployee->getUseridById($request->input('assign_to'));
                        $route_url="ticket-list";
                        $ret = $objNotification->addNotification($u_id,$ticketName,$route_url,$notificationMasterId);
                    }

                    $return['status'] = 'success';
                    $return['message'] = 'Ticket created successfully.';
                    $return['redirect'] = route('ticket-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something will be wrong.';
                }
            }

            echo json_encode($return);
            exit;
        }

        $data['employee_list'] = $employee_list;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket.js', 'jquery.form.min.js');
        $data['funinit'] = array('Ticket.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['css_plugin'] = array(
                                  'bootstrap-fileinput/bootstrap-fileinput.css',  
                                );
        $data['header'] = array(
            'title' => 'Ticket',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Tickets' => route("ticket-list"),
                'Add Ticket'=>'Add Ticket'));
        return view('company.ticket.ticket-add', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objTicket = new Ticket();
                $ticketList = $objTicket->getdatatable($request);
                echo json_encode($ticketList);
                break;
            case 'ticketDetails':
                $result = $this->getTicketDetailsJson($request->input('data'));
            break;
            case 'ticketEdit':
                $result = $this->getTicketDetails($request->input('data'));
            break;
            /*case 'deleteDepartment':
                $result = $this->deleteDepartment($request->input('data'));
                break;*/
        }
    }

    public function downloadAttachment(Request $request,$file_name)
    {
        // echo "<pre>"; print_r($file_name); exit();
        $file = public_path(). "/uploads/ticket_attachment/".$file_name;
        if(file_exists($file))
        {
            // $headers = array(
            //           'Content-Type: application:image/png',
            //         );
            return Response::download($file,$file_name);
        }
        else
        {
            return redirect('company/ticket-list')->with('status', 'file not found!');
        }
    }

    public function getTicketDetailsJson($postData)
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $ticketDetails = Ticket::select('tickets.code', 'tickets.subject', 'tickets.status', 'tickets.priority', 'tickets.details', 'tickets.created_by', 'tickets.assign_to', 'emp.name as emp_name')
                            ->join('employee as emp', 'tickets.assign_to', '=', 'emp.id')
                            ->where('tickets.id', $postData)
                            ->first();

        echo json_encode($ticketDetails);
        exit;
    }

    public function getTicketDetails($postData)
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $ticketDetails = Ticket::select('tickets.id','tickets.code', 'tickets.subject', 'tickets.status', 'tickets.priority', 'tickets.details', 'tickets.created_by', 'tickets.assign_to', 'emp.name as emp_name')
                            ->join('employee as emp', 'tickets.assign_to', '=', 'emp.id')
                            ->where('tickets.id', $postData)
                            ->first();

        return $ticketDetails;
    }

    public function viewTicketComments($id,Request $request){
        $session = $request->session()->all();

        if ($request->isMethod('post')) {
            $objTicketComment = new TicketComment();
            $result = $objTicketComment->saveTicketComment($request);
            if($result) {
                $return['status'] = 'success';
                $return['message'] = 'Ticket Comment successfully.';
                // $rt='ticket-comments/'.$id;
                $return['redirect'] = $id;
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }

            echo json_encode($return);
            exit;
        }
            
        $objEmployee = new Employee();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $ticket_details = $this->getTicketDetails($id);
        $objTicketComment = new TicketComment();
        $ticket_comment = $objTicketComment->getTicketCommentDetails($id);
            // print_r($ticket_comment);exit;
            
        $session = $request->session()->all();
        $data['ticket_details'] = $ticket_details;
        $data['ticket_comment'] = $ticket_comment;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket.js', 'jquery.form.min.js');
        $data['funinit'] = array('Ticket.addComments()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['css_plugin'] = array(
                                  'bootstrap-fileinput/bootstrap-fileinput.css',  
                                );
        $data['header'] = array(
            'title' => 'Ticket',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Tickets' => route("ticket-list"),
                'Ticket Details'=>'Ticket Details'));
        return view('company.ticket.ticket-comments', $data);
    }

    
}
