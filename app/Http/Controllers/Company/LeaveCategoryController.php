<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class LeaveCategoryController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index() {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/leave_category.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('LeaveCategory.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Leave Category List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Leave Category' => 'Leave Category'));

        return view('company.leave-category.leave-category-list', $data);
    }

    public function ajaxAction(Request $request)
    {
    	print_r('x');exit();
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                // $announmntObj = new Award;
                // $AnnounmntList = $announmntObj->getAwardList($request, $companyId->id);
                echo json_encode($AnnounmntList);
                break;
        }
    }

    public function leaveCategoryAdd(Request $request) {
         if ($request->isMethod('post')) {
            $objUsers = new Users();
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            
            $userId = $objUsers->addEmp($request);
            if ($userId == false) {
                $return['status'] = 'error';
                $return['message'] = 'Email Already Exists.!';
            }elseif ($userId) {
                $objEmployee = new Employee();
                $empId = $objEmployee->addEmployee($request,$userId, $companyId->id);
                $return['status'] = 'success';
                $return['message'] = 'Employee created successfully.';
                $return['redirect'] = route('employee-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/leave_category.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('LeaveCategory.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
        'title' => 'Employee Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Leave Category' => route("leave-category"),
                'Add New Leave Type' => 'Add New Leave Type',
            ));
        return view('company.leave-category.leave-category-add', $data);
    } 
}
