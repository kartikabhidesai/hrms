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

class OrderReportController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    
    public function index(Request $request){

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('');
        $data['funinit'] = array('');
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