<?php
namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Config;
use APP;
use Illuminate\Http\Request;

class EmployeeController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

     public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/employee.js');
        $data['funinit'] = array('Company.init()');
        $data['css'] = array('');
        return view('company.employee.employee-list', $data);
    }   

    public function add(Request $request) {
         if ($request->isMethod('post')) {
            $objDemo = new Employee();
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
        $data['js'] = array('company/employee.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Employee.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.employee.employee-add', $data);
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
                $return['message'] = 'Employee delete successfully.';
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