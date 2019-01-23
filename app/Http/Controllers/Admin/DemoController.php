<?php

namespace App\Http\Controllers\Admin;
use App\Model\Users;
use App\Model\Demo;
use App\Http\Controllers\Controller;
use App\Model\Sendmail;
use Illuminate\Http\Request;
use Config;

class DemoController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/demo.js');
        $data['funinit'] = array('Demo.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Companyies',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Demo' => 'Demo'));
        return view('admin.demo.list', $data);
        
    }   

    public function add(Request $request) {
         if ($request->isMethod('post')) {
            $objDemo = new Demo();
            $ret = $objDemo->addDemo($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record created successfully.';
                $return['redirect'] = route('list-demo');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['testarray'] = Config::get('constants.testarray');
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/demo.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Demo.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Companyies',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Demo' => route("list-demo"),
                'Add Demo' => 'Add Demo',));
        return view('admin.demo.add', $data);
    } 
    public function edit(Request $request,$id) {
        $data['testarray'] = Config::get('constants.testarray');
        $data['detail'] = Demo::find($id);

        if ($request->isMethod('post')) {
            $objDemo = new Demo();
            $ret = $objDemo->editDemo($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('list-demo');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/demo.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Demo.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
         $data['header'] = array(
            'title' => 'Companyies',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Demo' => route("list-demo"),
                'Edit Demo' => 'Edit Demo',));
        return view('admin.demo.edit', $data);
    }


    public function deleteDemo($postData) {
        if ($postData) {
            $result = Demo::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
//                $return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#dataTables-example').refresh();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objDemo = new Demo();
                $demoList = $objDemo->getData($request);
                echo json_encode($demoList);
                break;
            case 'deleteDemo':
                $result = $this->deleteDemo($request->input('data'));
                break;
        }
    }


    public function sendMail(){
        $mailData['subject'] = 'Calls - Sent Email';
        $mailData['attachment'] = array();
        $mailData['mailto'] = 'shaileshvanaliya91@gmail.com';
        // $mailData['mailto'] = $request->input('caller_email');
        $sendMail = new Sendmail;
        $mailData['data']['caller_note'] = 'dsad';
        $mailData['template'] = 'emails.test-mail';
        $result = $sendMail->sendSMTPMail($mailData);
        dump($result);exit;
    }
  
}
