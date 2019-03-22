<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                $announmntObj = new Award;
                $AnnounmntList = $announmntObj->getAwardList($request, $companyId->id);
                echo json_encode($AnnounmntList);
                break;
            case'awardDetails':
                $result = $this->getAwardDetails($request->input('data'));
                break;
            case'deleteAward':
                $result = $this->deleteAward($request->input('data'));
                break;
        }
    }
}
