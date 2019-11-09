<?php

namespace App\Http\Controllers\Company;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\WorkingDaySetting;
use App\Model\NonWorkingDate;
use Auth;
use Config;

class WorkingDaySettingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {

        $session = $request->session()->all();
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        if ($request->isMethod('post')) {
            $objWorkingDaySetting = new WorkingDaySetting();
            $ret = $objWorkingDaySetting->addWorkingDaySetting($request, $companyId->id);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Working Day Setting update successfully.';
                $return['redirect'] =  route('working-day-setting');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while creating new working-day-setting!';
            }
            echo json_encode($return);
            exit;
        }

        $data['workingdaysetting']=$this->getWorkingDaySettingDetails();
        
        $objNonWorkingDate = new NonWorkingDate();
        $data['nonworkingdate']=$objNonWorkingDate->getCompanyNonWorkingDateList($companyId->id);
        // print_r($data);exit;
        $data['day_works'] = Config::get('constants.day_works');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/workingdaysetting.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('WorkingDaySetting.init()');
        $data['css'] = array('jquery.timepicker.css','plugins/jasny/jasny-bootstrap.min.css');
        $data['css_plugin'] = array(
                                  'bootstrap-fileinput/bootstrap-fileinput.css',  
                                );
        $data['header'] = array(
            'title' => 'Working Day Setting',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Working Day Setting' => 'Working Day Setting'));

        return view('company.workingdaysetting.working-day-setting-edit', $data);
    }

    public function ajaxAction(Request $request)
    {
       
    	$action = $request->input('action');
    	$userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();
        
        switch ($action) {
            case 'addNonWorkingDate':
                $objNonWorkingDate = new NonWorkingDate();
                $newEvent = $objNonWorkingDate->addNonWorkingDate($request, $companyId->id);

                if ($newEvent) {
	                $return['status'] = 'success';
	                $return['message'] = 'Non Working Date created successfully.';
	                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
	                $return['redirect'] = route('working-day-setting');
                        
	            } else {
	                $return['status'] = 'error';
	                $return['message'] = 'Something went wrong while creating new Event!';
	            }
                echo json_encode($return);
            exit;
            break;
    	}
    }


    public function getWorkingDaySettingDetails()
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $workingDaySettingDetails = WorkingDaySetting::select('working_day_setting.*')
                            ->where('company_id', $companyId->id)
                            ->first();

        return $workingDaySettingDetails;
        exit;
    }
}
