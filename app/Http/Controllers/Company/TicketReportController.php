<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Users;
use App\Model\Company;
use App\Model\Department;
use App\Model\Employee;
use App\Model\TicketReport;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;

class TicketReportController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $userid = $session['logindata'][0]['id'];
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $data['departments'] = Department::where('company_id', $companyId['id'])->get();
        $dataPdf = array();
        if ($request->isMethod('post')) {
            $postData = $request->input();
            // print_r($postData);exit;
            $empArray = $postData['emparray'];
            $empEmplodeArray = explode(',', $empArray);
            foreach ($empEmplodeArray as $key => $value) {
                $objTicketReport = new TicketReport();
                if(empty($postData['downloadstatus'])){
                    $employeeArr = $objTicketReport->addTicketReport($postData,$value);    
                }
                
                $employeeArr = $objTicketReport->getTicketReportPdfDetail($postData,$value);  
                    if(!empty($employeeArr)){
                        $dataPdf[] = $employeeArr[0];
                    }
                }
            }
            // print_r($dataPdf);exit;
            if(count($dataPdf) > 0){
                $data['empPdfArray'] = $dataPdf;
                $file= date('dmYHis')."ticket-system.pdf";
                $pdf = PDF::loadView('company.ticket-report.ticket-pdf', $data);
                return $pdf->download($file);    
            }

        $objTicketReport = new TicketReport();
        $data['ticketSystemArray'] = $objTicketReport->getTicketSystemData();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket_report.js');
        $data['funinit'] = array('TicketReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Ticket Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Ticket Report' => 'ticket-report-list'));
        return view('company.ticket-report.ticket-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case'deleteTicketSystem':
                $result = $this->deleteTicket($request->input('data'));
                break;
        }
    }

    public function deleteTicket($postData) {
        if ($postData) {
            $findAnnounmnt = TicketReport::where('id', $postData['id'])->first();
            $result = $findAnnounmnt->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        location.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

}