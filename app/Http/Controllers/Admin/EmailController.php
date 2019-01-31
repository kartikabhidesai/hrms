<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Emails;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class EmailController extends Controller {

    public function index (Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/email.js');
        $data['funinit'] = array('Email.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Email' => 'Email'));
        return view('admin.emailtemplate.list', $data);
    }
    
    public function addMail(Request $request){
        $session = $request->session()->all();
        
        if($request->isMethod('post')){
//            print_r($request->input());exit;
           
            $objEmail=new Emails();
            $result=$objEmail->addemailTemplate($request);
            if($result){
                $return['status'] = 'success';
                $return['message'] = 'Email template created successfully.';
                $return['redirect'] = route('list-email');
            }else{
                $return['status'] = 'error';
                $return['message'] = "Something goes to wrong.";
            }
            echo json_encode($return);
            exit;
        }
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/email.js');
        $data['funinit'] = array('Email.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Add Email Template' => 'Add-Email'));
        return view('admin.emailtemplate.addemail', $data);
    }
    
    public function editMail(Request $request,$id=null){
        $session = $request->session()->all();
        $data['id']=$id;
        if($request->isMethod('post')){
//            print_r($request->input());exit;
           
            $objEmail=new Emails();
            $result=$objEmail->editemailTemplate($request);
            if($result){
                $return['status'] = 'success';
                $return['message'] = 'Email template created successfully.';
                $return['redirect'] = route('list-email');
            }else{
                $return['status'] = 'error';
                $return['message'] = "Something goes to wrong.";
            }
            echo json_encode($return);
            exit;
        }
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/email.js');
        $data['funinit'] = array('Email.edit()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Email',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Edit Email Template' => 'Add-Email'));
        return view('admin.emailtemplate.editemail', $data);
    }
}