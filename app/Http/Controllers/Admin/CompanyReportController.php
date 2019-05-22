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
use Config;

class CompanyReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){
        $data['companyReportArray'] = CompanyReport::all();
        if ($request->isMethod('post')){
                $clientReportObj = new CompanyReport;
                $data['companyDetails'] = $clientReportObj->getCompanyPdfData($request);     
                $result = $clientReportObj->addCompanyReport($request);         

                $subcription =Config::get('constants.subcription');
                $request_type =Config::get('constants.request_type');
                $payment_type =Config::get('constants.payment_type');

                if(!empty($data['companyDetails']))
                {
                    foreach ($data['companyDetails'] as $key => $value) 
                    {
                        // $data['companyDetails'][$key]['subcription'] = @$subcription[$value['subcription']];
                        $data['companyDetails'][$key]['request_type'] = @$request_type[$value['request_type']];
                        $data['companyDetails'][$key]['payment_type'] = @$payment_type[$value['payment_type']];
                    }
                }
                else
                {
                    return redirect()->back();
                }
                // echo "<pre>as"; print_r($data['companyDetails']); exit();
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
                $objCompanyReport = new CompanyReport;
                $companyReportList = $objCompanyReport->getCompanyReportData($request);
                echo json_encode($companyReportList);
                break;
            case'deleteCompanyReport':
                $objCompanyReport = CompanyReport::find($request->data['id']);
                if($objCompanyReport->delete())
                {
                    return redirect('admin/company-report')->with(json_encode(['success','Record deleted successfully.']));
                }
                else
                {
                    return redirect('admin/company-report')->with(json_encode(['failed','Something Went Wrong.']));
                }
                break;
        }
    }
}