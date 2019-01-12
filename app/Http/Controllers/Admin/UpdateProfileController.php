<?php

/**
 * Controller Name: UpdateProfileController
 * Descripation: Use to manage user profile 
 * Created date: 17 AUG 2017
 */

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Route;
use Illuminate\Http\Request;
use Config;

class UpdateProfileController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function editProfile(Request $request) {
        
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
            // print_r($request->file());
            // print_r($request->input());
            // exit;
            $objuseredit = new Users();
            $edituserinfo = $objuseredit->saveEditUserInfo($request);
            if ($edituserinfo) {
                $return['status'] = 'success';
                $return['message'] = 'User Info Edit successfully.';
                if (Auth::guard('company')->check()) {
                   $return['redirect'] = route('company-dashboard');
                }elseif (Auth::guard('employee')->check()) {
                   $return['redirect'] = route('employee-dashboard');
                }else{
                   $return['redirect'] = route('admin-dashboard');
                }
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
                 if (Auth::guard('client')->check()) {
                   // $return['redirect'] = route('client-dashboard');
                }else{
                   // $return['redirect'] = route('admin-dashboard');
                }
            }
            echo json_encode($return);
            exit;
        }
        $data['header'] = array(
            'title' => 'Employee',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Update Profile' => 'Update Profile'));
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js',
            );
        $data['js'] = array('admin/updateprofile.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['css_plugin'] = array(
          'bootstrap-fileinput/bootstrap-fileinput.css',  
        );
        $data['funinit'] = array('Updateprofile.edit_init()');
        return view('admin.profile.user-edit', $data);
    }
}
