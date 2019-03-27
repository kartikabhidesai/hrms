<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
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