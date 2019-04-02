<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use PDF;
use App\Model\Payroll;
use Illuminate\Http\Request;

class TransactionReportController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/transaction-report.js');
        $data['funinit'] = array('TransactionReport.init()');
         if ($request->isMethod('post')) {
            $postData = $request->input();
            $objPayroll = new Payroll();
            $dataPdf = $objPayroll->getTransactionDetails($postData);
               
            if(count($dataPdf) > 0){
                $data['empPdfArray'] = $dataPdf;
                $file= "TransactionReport".date('dmYHis').".pdf";
                $pdf = PDF::loadView('company.transaction-report.transaction-pdf', $data);
                return $pdf->download($file);    
            }
        }

        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Transaction Report' => 'transaction-report'));
        return view('company.transaction-report.transaction-report', $data);
    }

}