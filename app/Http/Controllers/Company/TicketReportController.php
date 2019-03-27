<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class TicketReportController extends Controller {

    public function __construct() {
        // parent::__construct();
        $this->middleware('company');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/ticket-report.js');
        $data['funinit'] = array('TicketReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Ticket Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => route("report-list"),
                'Ticket Report' => 'ticket-report-list'));
        return view('company.ticket-report.ticket-report', $data);
    }

}