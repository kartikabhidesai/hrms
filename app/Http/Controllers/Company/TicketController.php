<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Ticket;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use App\Model\Designation;
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

        $userID = $this->loginUser;
        $companyId = Company::select('id')->where('user_id', $userID->id)->first();
        // print_r($arrRejectCount);exit;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket.js');
        $data['funinit'] = array('Ticket.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Ticket List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Tickets' => 'Tickets'));

        // echo "asas"; exit();

        return view('company.ticket.ticket-list', $data);
    }
    
    public function add(Request $request){
        $session = $request->session()->all();

        if ($request->isMethod('post')) {
            // print_r($request->all()); exit();
            $objTicket = new Ticket();
            $result = $objTicket->saveTicket($request);
            if($result) {
                $return['status'] = 'success';
                $return['message'] = 'Ticket created successfully.';
                $return['redirect'] = route('ticket-list');
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
        $employee_list = $objEmployee->getEmployeeList($companyId->id);

        $session = $request->session()->all();
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
                $demoList = $objTicket->getdatatable();
                echo json_encode($demoList);
            break;
            case 'deleteDepartment':
                $result = $this->deleteDepartment($request->input('data'));
                break;
        }
    }}
