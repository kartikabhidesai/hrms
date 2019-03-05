<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Training;
use App\Model\Company;
use App\Model\Department;
use App\User;
use App\Model\Users;
use App\Model\Employee;
use Auth;
use Route;

class TrainingController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request)
    {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('training/training.js');
        $data['funinit'] = array('Training.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Training' => 'Training'));
        return view('company.training.training-list', $data);
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
                $return['redirect'] = route('training-list');
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
        $data['js'] = array('company/training.js', 'jquery.form.min.js');
        $data['funinit'] = array('Training.add()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Training Add',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Training Add' => 'Training'));

        return view('company.training.training-add', $data);
    }
}
