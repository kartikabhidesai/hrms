<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Training;
use App\Model\Company;
use App\Model\Department;
use App\Model\TraningEmployeeDepartment;
use App\User;
use App\Model\Users;
use App\Model\Employee;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Session;
use Auth;
use Route;

class TrainingController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('employee');
    }

    public function index(Request $request)
    {
        $session = $request->session()->all();

        $items = Session::get('notificationdata');
        $userID = $this->loginUser;
        $objNotification = new Notification();
        $items=$objNotification->SessionNotificationCount($userID->id);        
        Session::put('notificationdata', $items);
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/training.js');
        $data['funinit'] = array('Training.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Training' => 'Training'));
        return view('employee.training.training-list', $data);
    }

    public function addTraining(Request $request)
    {
        $session = $request->session()->all();
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        if ($request->isMethod('post')) {
            $objCompany = new Training();
            $ret = $objCompany->addTraining($request, $companyId->id);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Training created successfully.';
                $return['redirect'] = route('training');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Somethin went wrong while creating new training!';
            }
            echo json_encode($return);
            exit;
        }
       
        $objdepartment = new Department();
        $objDesignation = new Employee();
        $data['department'] = $objdepartment->getDepartment();
        $data['employee'] = $objDesignation->getEmployee($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/training.js', 'jquery.form.min.js');
        $data['funinit'] = array('Training.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Training Add',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Training Add' => 'Training'));

        return view('employee.training.training-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objTraining = new Training();
                $userID = $this->loginUser->id;
                $empId = Employee::select('id')->where('user_id', $userID)->first();
               
                $demoList = $objTraining->getTrainingEmployeeDatatable($request, $empId->id);
                echo json_encode($demoList);
                break;
            case 'getTraningDetail':
                $objTraining = new Training();
                $demo = $objTraining->getTrainingDetails($request->input('data'));
                echo json_encode($demo[0]);
                break;
            case 'deleteTraining':
                $result = $this->deleteTraining($request->input('data'));
                break;
            case 'getDepartmentTrainingList':
                $result = $this->getDepartmentTrainingList($request->input('department_id'));
                break;
        }
    }

    public function deleteTraining($postData) {
        if ($postData) {
            // $findTraining = Training::where('id', $postData['id'])->first();
            // if($findTraining) {
            //     $deleteUser = Users::where('id', $findEmp->user_id)->delete();
            // }
            $result = Training::where('id', $postData['id'])->delete();
            $result = TraningEmployeeDepartment::where('training_id', $postData['id'])->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Training delete successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#trainingTable').DataTable().ajax.reload();
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
