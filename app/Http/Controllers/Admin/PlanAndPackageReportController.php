<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\PlanAndPackageReport;
use App\Model\Company;
use App\Model\PlanManagement;
use PDF;
use DB;

class PlanAndPackageReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){

        if ($request->isMethod('post')) 
        {

            if($request->subcription != '')
            {
                $companies = Company::where('subcription',strtoupper($request->subcription))->get()->toArray();
            }
            // echo "<pre>"; print_r($companies); exit();

            if(count($companies) > 0){

                if (!file_exists(public_path('/uploads/plan_and_package_report'))) {
                    mkdir(public_path('/uploads/plan_and_package_report'),'0777',false);
                }

                $data['companies'] = $companies;
                $plan_and_package_report= "plan-and-package-report_".time().".pdf";
                $pdf = PDF::loadView('admin.plan-package-report.plan-package-report-pdf', $data);
                $path = public_path(). "/uploads/plan_and_package_report/".$plan_and_package_report;                   
                $output = $pdf->output();
                // file_put_contents($path, $output);

                $insert = DB::table('plan_and_package_report')->insertGetId(['downloaded_report_subscription'=>$request->subcription,'download_date' =>date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

                $numlength = strlen((string)$insert);
                $append_letter = 7 - $numlength;
                $str = '';
                for($i=0;$i<=$append_letter;$i++)
                {
                    $str.='0';
                }
                $update = DB::table('plan_and_package_report')->where('id',$insert)->update(['num_of_report' =>$str.$insert]);

                return $pdf->download($plan_and_package_report);  
            }
            else
            {
                return redirect()->back()->with(['status'=>'failed','message'=>'Data not found.']);
            }   
        }

        $session = $request->session()->all();
        $data['planmanagement'] = PlanManagement::get();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/plan_and_package_report.js');
        $data['funinit'] = array('PlanAndPackageReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Plan & Package List',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("admin-report-list"),
                'Plan & Package List' => 'plan-package-report'));
        return view('admin.plan-package-report.plan-package-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $obj = new PlanAndPackageReport;
                $reportData = $obj->getPlanAndPackageReportData($request);
                echo json_encode($reportData);
                break;
            case'deletePlanAndPackageReport':
                $objPlanAndPackageReport = PlanAndPackageReport::find($request->data['id']);
                if($objPlanAndPackageReport->delete())
                {
                    return redirect('admin/plan-package-report')->with(json_encode(['success','Record deleted successfully.']));
                }
                else
                {
                    return redirect('admin/plan-package-report')->with(json_encode(['failed','Something Went Wrong.']));
                }
                break;
        }
    }
}