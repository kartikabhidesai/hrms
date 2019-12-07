<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Redirect;
use Config;
use App\Model\PlanManagement;
use App\Model\PlanFeature;
use App\Model\SendSMS;
class FrontendController extends Controller {

    public function __construct() {
    }
    
    public function index(){
        $objsendmail = new SendSMS();
        $data['userdetails'] = $objsendmail->userdetailsmail();
        $data['duration'] = array('1' => 'Month', '2' => '3 Month', '3' => '6 Month', '4' => 'Year',);
       
        $planObj = new PlanManagement();
        $data['plans'] = $planObj->getPlans();
        
        $data['subcription']=Config::get('constants.subcription');
        $data['title'] = "HRMS - Home" ;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('front.js','jquery.form.min.js');
        $data['funinit'] = array('Front.init()');
        $data['css'] = array('');
       
        return view('frontend.home', $data);
    }

}
