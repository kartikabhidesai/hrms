<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Leave;
use App\Model\Employee;
class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/leave.js');
        $data['funinit'] = array('Leave.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Leave',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Leave' => 'Leave'));
        
        return view('employee.leave.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaveadd(Request $request)
    {
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];
        $objEmployee=new Employee();
        $empdetails=$objEmployee->getEmploydetails($logindata['id']);
        $data['company_id']=$empdetails[0]->company_id;
        $data['emp_id']=$empdetails[0]->emp_id;
       
        if ($request->isMethod('post')) {
            
            $objLeave = new Leave();
            $ret = $objLeave->addnewleave($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Leave added successfully.';
                $return['redirect'] = route('employee-leave');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/leave.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Leave.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Add Leave',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Leave' => route("employee-leave"),
                'Add Leave'=>'Add Leave'));
        return view('employee.leave.add', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaveedit(Request $request,$id)
    {
        if ($request->isMethod('post')) {

            $objLeave = new Leave();
            $ret = $objLeave->editleave($request);
            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Leave updated successfully.';
                $return['redirect'] = route('employee-leave');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['leaveEdit'] = Leave::find($id);
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/leave.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Leave.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Edit Leave',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Leave' => route("employee-leave"),
                'Edit Leave'=>'Edit Leave'));
        return view('employee.leave.add', $data);
    }
    
     public function deleteLeave($postData) {
        if ($postData) {
            $result = Leave::where('id', $postData['id'])->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Leave delete successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#dataTables-leave').DataTable().ajax.reload();
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
                $objLeave = new Leave();
                $demoList = $objLeave->getLeaveDatatable($request);
                echo json_encode($demoList);
                break;
            case 'deleteLeave':
                $result = $this->deleteLeave($request->input('data'));
                break;
        }
    }

   
}
