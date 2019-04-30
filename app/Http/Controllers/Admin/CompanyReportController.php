<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\ClientReport;
use App\Model\Company;
use PDF;

class CompanyReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){

        if ($request->isMethod('post')) 
        {
            $userid = $this->loginUser->id;
            $companyId = Company::select('id','company_name')->where('user_id', $userid)->first();
           
            $clientReportObj = new ClientReport;
            $data['clientReportPdfArray'] = $clientReportObj->getClientReportListPDF($request, $companyId->id);
            
            if(!empty($data['clientReportPdfArray']))
            {
                $data['company_name'] = $companyId->company_name;
                   
                $clientReportObj = new ClientReport;
                $result = $clientReportObj->addClientReport();     
                
                $file= date('d-m-YHis')."client_report.pdf";
                $pdf = PDF::loadView('company.client-report.client-report-pdf', $data);
                return $pdf->download($file);
            }
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('');
        $data['funinit'] = array('');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Company Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("admin-report-list"),
                'Company Report' => 'admin-client-report'));
        return view('admin.company-report.company-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objClientReport = new ClientReport;
                $clientReportList = $objClientReport->getClientReportList($request);
                echo json_encode($clientReportList);
                break;
            case'downloadPDF':
                $result = $this->downloadPDF($request);
                break;
        }
    }
}