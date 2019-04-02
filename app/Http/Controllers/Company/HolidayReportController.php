<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Company;
use App\Model\Department;
use App\Model\Employee;
use App\Model\TicketReport;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;

class HolidayReportController extends Controller {

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
        $data['js'] = array('company/holiday_report.js');
        $data['funinit'] = array('HolidayReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Holiday Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Holiday Report' => 'holiday-report'));
        return view('company.holiday-report.holiday-report', $data);
    }

}