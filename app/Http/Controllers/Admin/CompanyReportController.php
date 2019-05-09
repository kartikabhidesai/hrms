<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\CompanyReport;
use App\Model\Company;
use PDF;

class CompanyReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){
        $data['companyReportArray'] = CompanyReport::all();
        if ($request->isMethod('post')){
                $clientReportObj = new CompanyReport;
                if($request->post('downloadstatus') != 'single'){
                    $result = $clientReportObj->addCompanyReport($request);         
                }
                $data['companyDetails'] = $clientReportObj->getCompanyPdfData($request);     
                $file= "Company-Repost" . date('dmYHis') .".pdf";
                $pdf = PDF::loadView('admin.company-report.company-report-pdf', $data);
                return $pdf->download($file);
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['css'] = array('');
        $data['js'] = array('admin/company-report.js');
        $data['funinit'] = array('CompanyReport.init()');
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