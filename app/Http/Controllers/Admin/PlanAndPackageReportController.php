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

class PlanAndPackageReportController extends Controller {

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