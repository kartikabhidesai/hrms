<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Company;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;
use App\Model\Advancesalary;

class AdvanceSalaryRequestController extends Controller {

    public function __construct() {
         $this->middleware('company');
    }
    
    public function requestList(Request $request){
            $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Advance Salary Request List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Advance Salary Request' => 'Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/advancesalaryrequest.js');
        $data['funinit'] = array('Advancesalaryrequest.init()');
        $data['css'] = array('');

        return view('company.advancesalaryrquest.request-list', $data);
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        
        switch ($action) {
            
            case 'getdatatable':
                $id = Auth()->guard('company')->user()['id'];
                $companyId = Company::select('id')->where('user_id', $id)->first();
                $objAdvanceSalary=new Advancesalary();
                $datalist=$objAdvanceSalary->getCompanyAdvanceSalaryList($companyId['id']);
                echo json_encode($datalist);
                break;
            case 'approveRequest':
                    $id=$request->input('data')['id'];
                    $objAdvancesalary=new Advancesalary();
                    $approveRequest=$objAdvancesalary->approveRequest($id);
                    if ($approveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Advance salary request approved';
                        $return['redirect'] = route('campany-advance-salary-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
                    
               case 'disapproveRequest':
                    $id=$request->input('data')['id'];
                    $objAdvancesalary=new Advancesalary();
                    $disapproveRequest=$objAdvancesalary->disapproveRequest($id);
                    if ($disapproveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Advance salary request rejected';
                        $return['redirect'] = route('campany-advance-salary-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
        }
    }

    public function approvedRequestList(Request $request)
    {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Approved Salary Request List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Approved Advance Salary Request' => 'Approved Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/advancesalaryrequest.js');
        $data['funinit'] = array('Advancesalaryrequest.initApprovedReqList()');
        $data['css'] = array('');

        return view('company.advancesalaryrquest.approved-request-list', $data);
    }

    public function approvedListAjaxaction(Request $request)
    {
        $action = $request->input('action');
        
        switch ($action) {
            case 'getdatatable':
                $id = Auth()->guard('company')->user()['id'];
                $companyId = Company::select('id')->where('user_id', $id)->first();
                $objAdvanceSalary = new Advancesalary();
                $datalist=$objAdvanceSalary->getCompanyApprovedAdvanceSalaryList($companyId['id']);
                echo json_encode($datalist);
                break;
            }
    }
    
    public function downloadApprovedPdf(Request $request){
        if($request->method('post')){
            $objAdvanceSalary=new Advancesalary();
            $data['advanceSalaryApprovedRequest']=$objAdvanceSalary->getDetails($request);
//            $pdf = PDF::loadView('company.advancesalaryrquest.advance-salary-rquest-pdf', $data);
//            return response()->download(public_path('uploads/comapany/advance-salary'.date('Y-m-d').pdf));
        }
    }
}
