<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\FinanceReport;
use App\Model\Company;
use PDF;

class FinanceReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){

        if ($request->isMethod('post')) 
        {
            return redirect()->back()->with(['status'=>'failed','message'=>'Data not found.']);
            if($request->status == 'all' || $request->status == '')
            {
//                echo "<pre>"; print_r($request->toArray()); exit();
                $finances = Finance::get()->toArray();
            }
            else
            {
                $finances = Finance::where('status',$request->status)->get()->toArray();   
            }

            $subcription =Config::get('constants.subcription');
            $request_type =Config::get('constants.request_type');
            $payment_type =Config::get('constants.payment_type');


            if(!empty($finances))
            {
                foreach ($finances as $key => $value) 
                {
                    // $finances[$key]['subcription'] = $subcription[$value['subcription']];
                    $finances[$key]['request_type'] = $request_type[$value['request_type']];
                    $finances[$key]['payment_type'] = $payment_type[$value['payment_type']];
                }
            }

            if(count($finances) > 0){

                if (!file_exists(public_path('/uploads/finance_report'))) {
                    mkdir(public_path('/uploads/finance_report'),'0777',false);
                }

                $data['finances'] = $finances;
                $finance_report= "finance-report_".time().".pdf";
                $pdf = PDF::loadView('admin.finance-report.finance-report-pdf', $data);
                $path = public_path(). "/uploads/finance_report/".$finance_report;                   
                // PDF::loadHTML('company.task-report.task-pdf', $data) ->setPaper('a4', 'portrait') ->save($path);
                // move_uploaded_file("pdf", $path);
                $output = $pdf->output();
    // $file_to_save = FCPATH . 'assets/surat_acara/' . $new_filename . '.pdf';
                file_put_contents($path, $output);

                $insert = DB::table('finance_report')->insertGetId(['downloaded_report_status'=>$request->status,'download_date' =>date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

                $numlength = strlen((string)$insert);
                $append_letter = 7 - $numlength;
                $str = '';
                for($i=0;$i<=$append_letter;$i++)
                {
                    $str.='0';
                }
                $update = DB::table('finance_report')->where('id',$insert)->update(['num_of_report' =>$str.$insert]);

                return $pdf->download($finance_report);  
            }
            else
            {
                $return['status'] = 'error';
                $return['message'] = 'Data not found.';
                echo json_encode($return);
                exit;
//                return redirect()->back()->with(['status'=>'failed','message'=>'Data not found.']);
            }   
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/finance_report.js');
        $data['funinit'] = array('FinanceReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Finance Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("admin-report-list"),
                'Finance Report' => 'finance-report'));
        return view('admin.finance-report.finance-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $FinanceReport = new FinanceReport;
                $financeReportList = $FinanceReport->getFinanceReportData($request);
                echo json_encode($financeReportList);
                break;
            case'FinanceReport':
                $FinanceReport = FinanceReport::find($request->data['id']);
                if($FinanceReport->delete())
                {
                    return redirect('admin/finance-report')->with(json_encode(['success','Record deleted successfully.']));
                }
                else
                {
                    return redirect('admin/finance-report')->with(json_encode(['failed','Something Went Wrong.']));
                }
                break;
        }
    }
}