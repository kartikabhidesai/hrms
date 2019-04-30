<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class ReportController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('');
        $data['funinit'] = array('');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Report',
            'breadcrumb' => array(
                'Home' => route("dashboard"),
                'Report List' => 'report-list'));
        return view('admin.report.report-list', $data);
    }

}