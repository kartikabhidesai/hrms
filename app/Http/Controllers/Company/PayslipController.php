<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Designation;
use App\Model\Attendance;
use App\Model\Payroll;
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
            $postData = $request->input();
            
            $empArray = $postData['empchk'];
            $dataPdf = array();
            
            foreach ($empArray as $key => $value) {
                $objPayroll = new Payroll();
                $employeeArr = $objPayroll->getPayslipPdfDetail($postData,$value);
//                    dd($employeeArr[0]);
                if(!empty($employeeArr)){
                    $dataPdf[] = $employeeArr[0];
                }
            }
       
            if(count($dataPdf) > 0){
                $data['empPdfArray'] = $dataPdf;
                $file= date('d-m-YHis')."payslip.pdf";
               // $file= public_path(). "/uploads/admin/info.pdf";
                $pdf = PDF::loadView('company.pay-slip.invoice-pdf', $data);
                return $pdf->download($file);    
            }
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
        $data['month']=$month;
        $data['year']=$year;
        
        $data['employDetail'] = $objEmployee->getEmployDetailV2($companyId,$year,$month, $employee, $department);
        
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
        for($i = 0; $i < 5;$i++){
            $data = array();
            $file= public_path(). "/uploads/admin/info".$i."pdf";
            $pdf = PDF::loadView('company.pay-slip.invoice-pdf1', $data);
            // return $pdf->download($file);    
            return $pdf->stream('whateveryourviewname.pdf');
        }
        
    } 
    
    public function generatePdf($postData){
         $data = array();
        $file= public_path(). "/uploads/admin/info.pdf";
        $pdf = PDF::loadView('company.pay-slip.invoice-pdf', $data);
        return $pdf->download($file);
        // $empArray = $postData['emparray'];
        // // foreach ($empArray as $key => $value) {
        //     $data = array();
        //     $objPayroll = new Payroll();
        //     $data['employeeArr'] = $objPayroll->getPayslipPdfDetail($postData);
        //     // if(!empty($data['employeeArr'])){
        //         $file= public_path(). "/uploads/admin/info.pdf";
        //         $pdf = PDF::loadView('company.pay-slip.invoice-pdf', $data);
        //         return $pdf->download($file);    
        //     // }
        // // }
    }
    
    
    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getempmodaldata':
                $data['employeeid']=$request->input('data.id');
                $data['year']=$request->input('data.year');
                $data['month']=$request->input('data.month');
                
                $objPayroll = new Payroll();
                $empmodaldata=$objPayroll->getPayslipmodalDetail($data);
                
                print_r($empmodaldata); exit;
                echo json_encode($empmodaldata);
                break;
           
        }
    }

}
