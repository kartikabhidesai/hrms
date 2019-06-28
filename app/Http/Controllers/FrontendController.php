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


class FrontendController extends Controller {

    public function __construct() {
    }
    
    public function index(){
        $data['subcription']=Config::get('constants.subcription');
        $data['title'] = "HRMS - Home" ;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('front.js','jquery.form.min.js');
        $data['funinit'] = array('Front.init()');
        $data['css'] = array('');
       
        return view('frontend.home', $data);
    }

}
