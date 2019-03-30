<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\ClientReport;

class ClientReportController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){



        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/client_report.js');
        $data['funinit'] = array('ClientReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Client Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Client Report' => 'client-report'));
        return view('company.client-report.client-report', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objClientReport = new ClientReport;
                $clientReportList = $objClientReport->getClientReportList($request);
                echo json_encode($clientReportList);
                break;
            case'awardDetails':
                $result = $this->getAwardDetails($request->input('data'));
                break;
            case'deleteAward':
                $result = $this->deleteAward($request->input('data'));
                break;
        }
    }

}