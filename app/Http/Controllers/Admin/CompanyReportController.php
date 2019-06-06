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
use DB;
use Config;

class CompanyReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){
        $data['companyReportArray'] = CompanyReport::all();
        if ($request->isMethod('post'))
        {
            $companyReportObj = new CompanyReport;
            $companyReportData = $companyReportObj->getCompanyPdfData($request);     

            // $subcription =Config::get('constants.subcription');
            // $request_type =Config::get('constants.request_type');
            // $payment_type =Config::get('constants.payment_type');

            if(count($companyReportData) > 0){

                if (!file_exists(public_path('/uploads/company_report'))) {
                    mkdir(public_path('/uploads/company_report'),'0777',false);
                }

                $data['companyDetails'] = $companyReportData;
                $company_report= "company-report_".time().".pdf";
                $pdf = PDF::loadView('admin.company-report.company-report-pdf', $data);
                $path = public_path(). "/uploads/company_report/".$company_report;                   
                $output = $pdf->output();
                // PDF::loadHTML('company.task-report.task-pdf', $data) ->setPaper('a4', 'portrait') ->save($path);
                // move_uploaded_file("pdf", $path);
                // $file_to_save = FCPATH . 'assets/surat_acara/' . $new_filename . '.pdf';
                // file_put_contents($path, $output);

                $insert = DB::table('company_report')->insertGetId(['status'=>$request->status,'download_date' =>date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

                $numlength = strlen((string)$insert);
                $append_letter = 7 - $numlength;
                $str = '';
                for($i=0;$i<=$append_letter;$i++)
                {
                    $str.='0';
                }
                $update = DB::table('company_report')->where('id',$insert)->update(['company_report_number' =>$str.$insert]);
                return $pdf->download($company_report);  
            }
            else
            {
                $return['status'] = 'error';
                $return['message'] = 'Data not found.';
                echo json_encode($return);
                exit;
//                return redirect()->back()->with(['status'=>'failed','message'=>'Data not found.']);
            }   
            // echo "<pre>as"; print_r($data['companyDetails']); exit();
            $file= "Company-Report" . date('dmYHis') .".pdf";
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