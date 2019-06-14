<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;
use App\Model\AdminUserHasPermission;
use App\Model\Users;
use App\Model\Chat;
use App\Model\Notification;

class FrontendController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/';
    public function __construct() {
        
    }
    
    public function index(){
        $data['title'] = "HRMS - Home" ;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('front.js','jquery.form.min.js');
        $data['funinit'] = array('Front.init()');
        $data['css'] = array('');
        return view('frontend.home', $data);
    }

}
