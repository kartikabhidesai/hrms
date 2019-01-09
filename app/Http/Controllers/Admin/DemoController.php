<?php

namespace App\Http\Controllers\Admin;
use App\Model\Users;
use App\Model\Demo;
use App\Http\Controllers\Controller;
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
  
}