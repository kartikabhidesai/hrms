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
use Response;
use Config;
use Excel;

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
    
    public function newRequest(Request $request){
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];

        $companyId = Company::select('id')->where('user_id', $logindata['id'])->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();

        if ($request->isMethod('post')) {
            // print_r($request->input());exit;
            $objNewSalaryRequest= new Advancesalary();
            $result=$objNewSalaryRequest->addSalaryRequest($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New Advance Salary  Request created successfully.';
                $return['redirect'] = route('campany-advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'New Advance Salary Request List',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Advance Salary Request list' => route('advance-salary-request'),
                'New Advance Salary Request' => 'New Advance Salary Request'));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/advancesalaryrequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Advancesalaryrequest.init()');
        $data['css'] = array('');

        return view('company.advancesalaryrquest.new-request-list', $data);
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

            case 'changeSalaryStatus':
                    $objAdvancesalary = new Advancesalary();
                    $disapproveRequest = $objAdvancesalary->changeAdvanceSalaryStatus($request->input('data'));
                    if ($disapproveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Status Changed successfully.';
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
        $data['monthis'] = Config::get('constants.months');
        $id = Auth()->guard('company')->user()['id'];
        $companyId = Company::select('id')->where('user_id', $id)->first();

        $data['get_year'] = $request->get('year');
        $data['get_month'] = $request->get('month');
        $data['month'] = $request->get('month');

        $objAdvanceSalary = new Advancesalary();
        $data['datalist'] = $objAdvanceSalary->getCompanyApprovedAdvanceSalaryListV2($companyId['id'],$data['get_year'],$data['month']);

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
    
    public function createApprovedPdf(Request $request){
        if($request->method('post')){
            $objAdvanceSalary=new Advancesalary();
            $data['advanceSalaryApprovedRequest']=$objAdvanceSalary->getDetails($request);
            $pdf = PDF::loadView('company.advancesalaryrquest.advance-salary-rquest-pdf', compact('data'));
            $pdfName='advance-salary'.time().'.pdf';
            $pdf->save(public_path('uploads/comapany/'.$pdfName));
            return $pdfName;
        }
    } 

    public function createApprovedExcel(Request $request){
        if($request->method('post')){
            $objAdvanceSalary=new Advancesalary();
            $advanceSalaryApprovedRequest = $objAdvanceSalary->getDetailsV2($request);
            // print_r($advanceSalaryApprovedRequest);exit;
           Excel::create('Approved Advance Salary Request-'.date('dmY'), function($excel) use ($advanceSalaryApprovedRequest){
                $headers = array('Name', 'Comment', 'Date of Submit', 'Department Name', 'Company Name','Phone');
                        $excel->sheet("Student_Offers_List", function($sheet) use ($headers, $advanceSalaryApprovedRequest) {
                        for ($i = 0; $i < count($advanceSalaryApprovedRequest); $i++) {
                            $sheet->prependRow($headers);
                            $sheet->fromArray(array(
                                array(
                                    $advanceSalaryApprovedRequest[$i]['name'],
                                    $advanceSalaryApprovedRequest[$i]['comments'],
                                    $advanceSalaryApprovedRequest[$i]['date_of_submit'],
                                    $advanceSalaryApprovedRequest[$i]['department_name'],
                                    $advanceSalaryApprovedRequest[$i]['company_name'],
                                    $advanceSalaryApprovedRequest[$i]['phone'],
                                )), null, 'A2', false, false);
                            }
                        });
                // $excel->sheet('Sheetname', function($sheet) {
                //     $sheet->fromArray(array(
                //         array('data1', 'data2'),
                //         array('data3', 'data4')
                //     ));
                // });
            })->export('xls');
        }
    }
    
    public function downloadApprovedPdf(Request $request){
        if($request->method('get')){
            $pdfName=$request->input('pdfname');
            $file=public_path('uploads/comapany/'.$request->input('pdfname'));
            return Response::download($file, $pdfName);
        }
    }
}
