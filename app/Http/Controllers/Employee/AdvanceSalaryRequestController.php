<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Payroll;
use App\Model\Advancesalary;

class AdvanceSalaryRequestController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }
    
    public function requestList(Request $request){
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Advance Salary Request List',
            'breadcrumb' => array(
                'Home / Advanc Salary Request' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js');
        $data['funinit'] = array('Advancesalaryrequest.init()');
        $data['css'] = array('');

        return view('employee.advancesalaryrquest.request-list', $data);
    }
    
    public function newRequest(Request $request){
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        $objEmployee=new Employee();
        $data['empdetails']=$objEmployee->getEmploydetails($logindata['id']);       
        
        if ($request->isMethod('post')) {
            $objNewSalaryRequest= new Advancesalary();
            $result=$objNewSalaryRequest->addSalaryRequest($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New Advance Salary  Request created successfully.';
                $return['redirect'] = route('advance-salary-request');
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
                'Home / New Advanc Salary Request' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Advancesalaryrequest.add()');
        $data['css'] = array('');

        return view('employee.advancesalaryrquest.new-request-list', $data);
    }
    
    public function editRequest(Request $request,$id){
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        $objEmployee=new Employee();
        $data['empdetails']=$objEmployee->getEmploydetails($logindata['id']);       
        
        $objAdvanceSalary=new Advancesalary();
        $data['result']=$objAdvanceSalary->getAdavanceDetails($id);
       
        if ($request->isMethod('post')) {
            $objNewSalaryRequest= new Advancesalary();
            $result=$objNewSalaryRequest->editSalaryRequest($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Advance Salary  Request edited successfully.';
                $return['redirect'] = route('advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'Edit Advance Salary Request List',
            'breadcrumb' => array(
                'Home / Edit Advanc Salary Request' => route("admin-dashboard")));
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/advancesalaryrequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Advancesalaryrequest.edit()');
        $data['css'] = array('');
        return view('employee.advancesalaryrquest.edit-request-list', $data);
    }
    
    public function deleteLeave($postData) {
        if ($postData) {
            $result = Advancesalary::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Advance salary request delete successfully.';
                 $return['redirect'] = route('advance-salary-request');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        
        switch ($action) {
            
            case 'getdatatable':
                $id = Auth()->guard('employee')->user()['id'];
                $objEmploye=new Employee();
                $employeid=$objEmploye->getUserid($id);
                
                $objAdvanceSalary=new Advancesalary();
                $datalist=$objAdvanceSalary->getAdvanceSalaryList($employeid);
                
                echo json_encode($datalist);
                break;
            
            case 'deleteLeave':
                $result = $this->deleteLeave($request->input('data'));
                break;
        }
    }
}
