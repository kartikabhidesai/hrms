<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Model\Award;
use App\Model\Designation;
use App\Model\Employee;
use App\Model\HolidayReport;
use App\Model\Recruitment;
use App\Model\Task;
use App\Model\TaskReport;
use App\Model\Ticket;
use App\Model\TicketReport;
use App\Model\Training;
use App\Model\TraningEmployeeDepartment;
use App\Model\Users;
use App\Model\Company;
use App\Model\Department;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use Config;

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
                'Home' => route("company-dashboard"),
                'Department' => 'Department'));
        return view('company.department.department-list', $data);
    }

    public function add(Request $request) {
        $session = $request->session()->all();

        if ($request->isMethod('post')) {
            $objDepartment = new Department();
            $result = $objDepartment->saveDepartment($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Department created successfully.';
                $return['redirect'] = route('department-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $userId = $session['logindata'][0]['id'];
        $companyId = Company::select("id")
                ->where("user_id", $userId)
                ->get();

        $objEmployee = new Employee();
        $data['employeelist'] = $objEmployee->allemployeelist($companyId[0]->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js', 'jquery.form.min.js');
        $data['funinit'] = array('Department.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['css_plugin'] = array(
            'bootstrap-fileinput/bootstrap-fileinput.css',
        );
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Department' => route("department-list"),
                'Add Department' => 'Add Department'));
        return view('company.department.department-add', $data);
    }

    public function edit(Request $request, $id) {
        $data['detail'] = Department::with('designation')->find($id);

        if ($request->isMethod('post')) {
            $objDepartment = new Department();
            $ret = $objDepartment->editDepartment($request);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('department-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Please add any one designation!';
            }

            echo json_encode($return);
            exit;
        }

        $session = $request->session()->all();
        $userId = $session['logindata'][0]['id'];
        $companyId = Company::select("id")
                ->where("user_id", $userId)
                ->get();

        $objEmployee = new Employee();
        $data['employeelist'] = $objEmployee->allemployeelist($companyId[0]->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/department.js', 'jquery.form.min.js');
        $data['funinit'] = array('Department.edit()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Department',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Department' => route("department-list"),
                'Edit Department' => 'Edit Department'));

        return view('company.department.department-edit', $data);
    }

    public function ajaxAction(Request $request) {
        $session = $request->session()->all();
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':

                $userId = $session['logindata'][0]['id'];
                $companyId = Company::select("id")
                        ->where("user_id", $userId)
                        ->get();
                $objEmployee = new Department();
                $demoList = $objEmployee->getdatatable($companyId[0]->id);
                echo json_encode($demoList);
                break;

            case 'deleteDepartment':
                $result = $this->deleteDepartment($request->input('data'));
                break;

            case 'getCompnanyDepartmentList':
                $result = $this->getCompnanyDepartmentList1();
                break;

            case 'employeelist':
                $session = $request->session()->all();
                $userId = $session['logindata'][0]['id'];
                $companyId = Company::select("id")
                        ->where("user_id", $userId)
                        ->get();

                $objEmployee = new Employee();
                $employeelist = $objEmployee->allemployeelist($companyId[0]->id);
                echo json_encode($employeelist);
                exit();
                break;
        }
    }

    public function deleteDepartment($postData) {
        if ($postData) {
            $findAward = Award::where('department', $postData['id'])->count();
            $findDesignation = Designation::where('department_id', $postData['id'])->count();
            $findEmployee = Employee::where('department', $postData['id'])->count();
            $findDepartment = Department::where('id', $postData['id'])->count();
            $findHoliday_report = HolidayReport::where('department_id', $postData['id'])->count();
            $findRecruitment = Recruitment::where('department_id', $postData['id'])->count();
            $findTask = Task::where('department_id', $postData['id'])->count();
            $findTask_report = TaskReport::where('department_id', $postData['id'])->count();
            $findTickets = Ticket::where('department_id', $postData['id'])->count();
            $findTicket_report = TicketReport::where('department_id', $postData['id'])->count();
            $findTraining = Training::where('department_id', $postData['id'])->count();
            $findTrainingEmployee = TraningEmployeeDepartment::where('department_id', $postData['id'])->count();

            if ($findAward || $findDesignation || $findEmployee || $findDepartment || $findHoliday_report || $findRecruitment || $findTask || $findTask_report || $findTickets || $findTicket_report || $findTraining || $findTrainingEmployee == 1) {
                $return['status'] = 'error';
                $return['message'] = 'Department is use another place';
            } else {
                $Department = Department::where('id', $postData['id'])->delete();
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                //$return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#DepartmentDatatables').DataTable().ajax.reload();
                    },1000)";
            }
            echo json_encode($return);
            exit;
        }
    }

    public function getCompnanyDepartmentList1() {
        // $session = $request->session()->all();
        // $userId = $this->loginUser->id;
        // $companyId = Company::select('id')->where('user_id', $userId)->first();
        $objdepartment = new Department();
        $data1 = Department::select('id', 'department_name')->get();
        // $return['status'] = 'success';
        // $return['message'] = 'Record deleted successfully.';
        echo json_encode($data1);
    }

}
