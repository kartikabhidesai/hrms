<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
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

    public function tickets(Request $request)
    {
        $session = $request->session()->all();

        $userID = $this->loginUser;
        $companyId = Company::select('id')->where('user_id', $userID->id)->first();
        $objManageList = new ManageTimeChangeRequest();
        $data['arrRejectCount'] = $objManageList->getStatusCount($companyId->id,'reject');
        $data['arrApproveCount'] = $objManageList->getStatusCount($companyId->id,'approve');
        $data['arrRemovedCount'] = $objManageList->getStatusCount($companyId->id,'removed');
        $data['arrNewCount'] = $objManageList->getStatusCount($companyId->id,'new');
        $data['arrModifiedCount'] = $objManageList->getStatusCount($companyId->id,'modified');
        $data['arrCanclledCount'] = $objManageList->getStatusCount($companyId->id,'canclled');
        // print_r($arrRejectCount);exit;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/timeChangeRequest.js');
        $data['funinit'] = array('TimeChangeRequest.init()');
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
            $objDepartment = new Department();
            $result = $objDepartment->saveDepartment($request);
            if($result) {
                $return['status'] = 'success';
                $return['message'] = 'Ticket created successfully.';
                $return['redirect'] = route('department-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }

            echo json_encode($return);
            exit;
        }

        $objEmployee = new Employee();
        $company_data = Auth::guard('company')->user();
        $employee_list = $objEmployee->getEmployeeList($company_data->id);

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
                'Tickets' => route("tickets"),
                'Add Ticket'=>'Add Ticket'));
        return view('company.ticket.ticket-add', $data);
    }
}
