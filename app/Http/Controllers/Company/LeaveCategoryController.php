<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Model\Company;
use App\Model\Role;
use App\Model\WorkLocation;
use App\Model\Period;
use App\Model\LeaveCategory;
use App\Model\ExperiencBased;

class LeaveCategoryController extends Controller {

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

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $leaveCategoryObj = new LeaveCategory;
                $leaveCategoryList = $leaveCategoryObj->getleaveCategoryList($request, $companyId->id);
                echo json_encode($leaveCategoryList);
                break;
            case 'addRoleName':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $roleObj = new Role;
                $roleList = $roleObj->createRole($request, $companyId->id);
                if ($roleList) {
                    $return['status'] = 'success';
                    $return['message'] = 'Role add successfully.';
                    //$return['redirect'] = route('emp-task-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Somethin went wrong while creating new role!';
                }
                echo json_encode($return);
                break;
            case 'addWorkName':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $workObj = new WorkLocation;
                $workAdd = $workObj->createWorkLocation($request, $companyId->id);
                if ($workAdd) {
                    $return['status'] = 'success';
                    $return['message'] = 'Work Location add successfully.';
                    // $return['redirect'] = route('emp-task-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Somethin went wrong while creating new role!';
                }
                echo json_encode($return);
                break;
            case 'addPeriod':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $periodObj = new Period;
                $workAdd = $periodObj->createNewPeriod($request, $companyId->id);
                if ($workAdd) {
                    $return['status'] = 'success';
                    $return['message'] = 'Work Location add successfully.';
                    // $return['redirect'] = route('emp-task-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Somethin went wrong while creating new role!';
                }
                echo json_encode($return);
                break;
            

            case 'getRoleCompanyList':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $roleObj = new Role;
                $roleList = $roleObj->getRoleCompanyList($companyId->id);
                echo json_encode($roleList);
                break;
            case 'getWorkLocationCompanyList':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $Obj = new WorkLocation;
                $workList = $Obj->getWorkLocationCompanyList($companyId->id);
                echo json_encode($workList);
                break;
            
            case 'getPeriodList':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $Obj = new Period;
                $PeriodList = $Obj->getPeriodCompanyList($companyId->id);
                echo json_encode($PeriodList);
                break;
            
            case 'deleteleave':
                
                $result = LeaveCategory::where('id', $request->input('data')['id'])->delete();
                if($result){
                    $resultNew = ExperiencBased::where('leave_categories_id', $request->input('data')['id'])->delete();
                    
                    $return['status'] = 'success';
                    $return['message'] = 'Leave categories successfully deleted.';
                    $return['redirect'] = route('leave-category');
                    
                }else{
                   $return['status'] = 'error';
                    $return['message'] = 'Somethin went wrong while creating new role!'; 
                }
                echo json_encode($return);
                break;
        }
    }

    public function leaveCategoryAdd(Request $request) {
        if ($request->isMethod('post')) {
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            // echo "<pre>"; print_r($companyId); print_r($request->toArray()); exit();
            $objLeaveCategory = new LeaveCategory;
            $leaveCategory = $objLeaveCategory->addnewleaveCategory($request, $companyId->id);
            
            if ($leaveCategory) {
                $return['status'] = 'success';
                $return['message'] = 'Leave Category created successfully.';
                $return['redirect'] = route('leave-category');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            // return redirect()->route('leave-category')->with($return);
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['leave_category_role'] = Config::get('constants.leave_category_role');
        $data['leave_work_location'] = Config::get('constants.leave_work_location');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/leave_category.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('LeaveCategory.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Leave Category Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Leave Category' => route("leave-category"),
                'Add New Leave Type' => 'Add New Leave Type',
        ));
        return view('company.leave-category.leave-category-add', $data);
    }

    public function leaveCategoryedit(Request $request,$id=NULL){
        if ($request->isMethod('post')) {
            $userid = $this->loginUser->id;
            $companyId = Company::select('id')->where('user_id', $userid)->first();
            
            $objLeaveCategory = new LeaveCategory;
            $leaveCategory = $objLeaveCategory->editnewleaveCategory($request);
            
            if ($leaveCategory) {
                $return['status'] = 'success';
                $return['message'] = 'Leave Category edited successfully.';
                $return['redirect'] = route('leave-category');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            // return redirect()->route('leave-category')->with($return);
            echo json_encode($return);
            exit;
        }
        
        $objLeaveCategory = new LeaveCategory;
        $data['leaveDetails']=$objLeaveCategory->leaveDetails($id);
        $objExperiencBased = new ExperiencBased;
        $data['getcount']=$objExperiencBased->getCount($data['leaveDetails'][0]['id']);
        $session = $request->session()->all();
        $data['leave_category_role'] = Config::get('constants.leave_category_role');
        $data['leave_work_location'] = Config::get('constants.leave_work_location');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/leave_category.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('LeaveCategory.edit()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Leave Category Edit',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Leave Category' => route("leave-category"),
                'Edit Leave Type' => 'Edit Leave Type',
        ));
        return view('company.leave-category.leave-category-edit', $data);
    }
}
