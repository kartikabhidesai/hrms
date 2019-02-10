<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use Auth;
use Route;
use Config;
use PDF;
class PayslipController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function create()
    {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/pay_slip.js', 'jquery.form.min.js','plugins/daterangepicker/daterangepicker.js');
        $data['monthis'] = Config::get('constants.months');
        $data['funinit'] = array('Paylip.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Attendance History',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Manage Attendance History' => 'Manage Attendance History'));
      
        return view('company.pay-slip.create', $data);
    }
    
    public function createPDF() {
        $data = array();
        // $target_path = 'pdf/test.pdf';
        $file= public_path(). "/uploads/admin/info.pdf";
        $pdf = PDF::loadView('company.pay-slip.invoice-pdf', $data);
        // return $pdf->stream();
        // exit;
        return $pdf->download($file);
        // return $pdf->download('invoice.pdfV2');
    }
}
