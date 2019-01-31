<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class SettingController extends Controller {

    public function index (Request $request){
        $session = $request->session()->all();
         $objSetting=new Setting();
         $data['setting']=$objSetting->getSetting();
         
        if($request->isMethod('post')){
            $objSetting=new Setting();
            $result=$objSetting->saveSetting($request);
            if($result){
                $return['status'] = 'success';
                $return['message'] = 'Website Setting created successfully.';
                $return['redirect'] = route('setting');
            }else{
                $return['status'] = 'error';
                $return['message'] = "Something goes to wrong.";
            }
              echo json_encode($return);
            exit;
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/setting.js');
        $data['funinit'] = array('Setting.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Setting',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Setting' => 'Setting'));
        return view('admin.setting.index', $data);
    }
}