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
use App\Model\OrderReport;
use App\Model\Order;
use PDF;
use DB;
use Config;

class OrderReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){

        if ($request->isMethod('post')) 
        {
            if($request->status == 'all' || $request->status == '')
            {
                $orders = Order::get()->toArray();
            }
            else
            {
                $orders = Order::where('status',$request->status)->get()->toArray();   
            }

            $subcription =Config::get('constants.subcription');
            $request_type =Config::get('constants.request_type');
            $payment_type =Config::get('constants.payment_type');


            if(!empty($orders))
            {
                foreach ($orders as $key => $value) 
                {
                    $orders[$key]['subcription'] = $subcription[$value['subcription']];
                    $orders[$key]['request_type'] = $request_type[$value['request_type']];
                    $orders[$key]['payment_type'] = $payment_type[$value['payment_type']];
                }
            }

            if(count($orders) > 0){

                if (!file_exists(public_path('/uploads/order_report'))) {
                    mkdir(public_path('/uploads/order_report'),'0777',false);
                }

                $data['orders'] = $orders;
                $order_report= "order-report_".time().".pdf";
                $pdf = PDF::loadView('admin.order-report.order-report-pdf', $data);
                $path = public_path(). "/uploads/order_report/".$order_report;                   
                // PDF::loadHTML('company.task-report.task-pdf', $data) ->setPaper('a4', 'portrait') ->save($path);
                // move_uploaded_file("pdf", $path);
                $output = $pdf->output();
    // $file_to_save = FCPATH . 'assets/surat_acara/' . $new_filename . '.pdf';
                // file_put_contents($path, $output);

                $insert = DB::table('order_report')->insertGetId(['downloaded_report_status'=>$request->status,'download_date' =>date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

                $numlength = strlen((string)$insert);
                $append_letter = 7 - $numlength;
                $str = '';
                for($i=0;$i<=$append_letter;$i++)
                {
                    $str.='0';
                }
                $update = DB::table('order_report')->where('id',$insert)->update(['num_of_report' =>$str.$insert]);

                return $pdf->download($order_report);  
            }
            else
            {
                return redirect()->back()->with(['status'=>'failed','message'=>'Data not found.']);
            }   
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/order_report.js');
        $data['funinit'] = array('OrderReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Order Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("admin-report-list"),
                'Order Report' => 'order-report'));
        return view('admin.order-report.order-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objOrderReport = new OrderReport;
                $orderReportList = $objOrderReport->getOrderReportData($request);
                echo json_encode($orderReportList);
                break;
            case'deleteOrderReport':
                $objOrderReport = OrderReport::find($request->data['id']);
                if($objOrderReport->delete())
                {
                    return redirect('admin/order-report')->with(json_encode(['success','Record deleted successfully.']));
                }
                else
                {
                    return redirect('admin/order-report')->with(json_encode(['failed','Something Went Wrong.']));
                }
                break;
        }
    }
}