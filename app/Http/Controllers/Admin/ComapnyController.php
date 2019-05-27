<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\NotificationMaster;
use App\Model\Users;
use App\Model\PlanManagement;
use Config;
use File;

class ComapnyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/company.js');
        $data['funinit'] = array('Company.init()');
        $data['css'] = array('');
        $data['header'] = array(
                'title' => 'Company',
                'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => 'Company'));
        return view('admin.company.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addNewCompany(Request $request) {
        $planmanagement = PlanManagement::get();
        if ($request->isMethod('post')) {

            $objCompany = new Company();
            $ret = $objCompany->addCompany($request);

            if ($ret) {
                $objNotificationMaster = new NotificationMaster();
                $objNotificationMaster->addNotificationMasterUser();
                $return['status'] = 'success';
                $return['message'] = 'Record created successfully.';
                $return['redirect'] = route('list-company');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'This email is already registerd!';
            }
            echo json_encode($return);
            exit;
        }
        $data['planmanagement'] = $planmanagement;
        
        $data['status'] = Config::get('constants.status');
        $data['subcription'] = Config::get('constants.subcription');
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/company.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Company.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => route("list-company"),
                'Add Company' => 'Add Company'));
        return view('admin.company.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany($postData) {
        if ($postData) {
            $objCompany = Company::where('id', $postData['id'])->first();
            $existImage = public_path('/uploads/admin/company/').$objCompany->company_image;

            if (File::exists($existImage)) { // unlink or remove previous company image from folder
                File::delete($existImage);
            }
            
            $deleteCompanyUser = Users::where('email', $objCompany->email)->delete();
            $result = $objCompany->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record delete successfully.';
                //$return['redirect'] = route('calls');
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#dataTables-company').DataTable().ajax.reload();
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
                $objCompany = new Company();
                $compnyList = $objCompany->getCompanyData($request);
                echo json_encode($compnyList);
                break;
            case 'deleteCompany':
                $result = $this->deleteCompany($request->input('data'));
                break;
        }
    }

    public function edit(Request $request, $id) 
    {
        $planmanagement = PlanManagement::get();
        $data['status'] = Config::get('constants.status');
        $data['subcription'] = Config::get('constants.subcription');
        $data['detail'] = Company::find($id);
        
        if ($request->isMethod('post')) {
            $objCompany = new Company();
            $ret = $objCompany->editCompany($request,$data['detail']['user_id']);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('list-company');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'This email is already registerd!';
            }

            echo json_encode($return);
            exit;
        }

        $data['planmanagement'] = $planmanagement;
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/company.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Company.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Company' => route("list-company"), 
                'Edit Company' => 'Edit Company'));

        return view('admin.company.edit', $data);
    }

}
