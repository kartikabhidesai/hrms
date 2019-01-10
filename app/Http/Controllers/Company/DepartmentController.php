<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Model\Department;
use App\Model\Designation;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class DepartmentController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js');
        $data['funinit'] = array('Department.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => 'Company'));
        return view('company.department.department-list', $data);
    }
    
    
    public function add(Request $request){
       
        if ($request->isMethod('post')) {
           $objDepartment=new Department();
           $result=$objDepartment->saveDepartment($request);
           if($result){
                $return['status'] = 'success';
                $return['message'] = 'Department created successfully.';
                $return['redirect'] = route('department-list');  
           }else{
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
           }
           echo json_encode($return);
           exit;
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js');
        $data['funinit'] = array('Department.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => 'Company'));
        return view('company.department.department-add', $data);
    }
    
    public function edit($id){
        
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objEmployee = new Department();
                $demoList = $objEmployee->getdatatable();
                echo json_encode($demoList);
            break;
            case 'deleteDepartment':
                $result = $this->deleteDepartment($request->input('data'));
                break;
        }
    }

    public function deleteDepartment($postData) 
    {
        if ($postData) 
        {
            $findDesignation = Designation::where('department_id', $postData['id'])->get();
            $findDepartment = Department::where('id', $postData['id'])->first();
            $deleteDesignation = $findDepartment->designation()->delete();
            $result = $findDepartment->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
                //$return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#DepartmentDatatables').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

}