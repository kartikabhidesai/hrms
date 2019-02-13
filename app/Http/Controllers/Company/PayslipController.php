<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Designation;
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

    public function create(Request $request)
    {   
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $companyId = $getAuthCompanyId->id;
        if ($request->isMethod('post')) {
            // print_r($request->input());exit;
        }
        $department = (empty($request->get('department'))) ? '' : $request->get('department');
        $employee = (empty($request->get('employee'))) ? '' : $request->get('employee');
        $year = (empty($request->get('year'))) ? '' : $request->get('year');
        $month = (empty($request->get('month'))) ? '' : $request->get('month');

        $data['detail'] = $this->loginUser;
        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId);   

        $objEmployee = new Employee();
        $data['employee'] = $objEmployee->getEmployee($companyId);
        $data['employDetail'] = $objEmployee->getEmployDetailV2($companyId,$year, $month, $employee, $department);
        // print_r($data['employDetail']);exit;
        $data['monthis'] = Config::get('constants.months');

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/pay_slip.js');
        $data['funinit'] = array('Paylip.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Pay Slip',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Pay Slip' => 'Pay Slip'));
      
        return view('company.pay-slip.create', $data);
    }
    
    public function createPDF(){
        $data = array();
        $file= public_path(). "/uploads/admin/info.pdf";
        $pdf = PDF::loadView('company.pay-slip.invoice-pdf', $data);
        return $pdf->download($file);
    }
}
