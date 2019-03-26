<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Department;
use Auth;

class ClientController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index() {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/award.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Award.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Client List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Client' => 'Client'));

        return view('company.client.client-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addClient(Request $request) {
        $session = $request->session()->all();
        $logindata = $session['logindata'][0];

        $companyId = Company::select('id')->where('user_id', $logindata['id'])->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $deptObj = new Department();
        $data['getDepartmentOfCompany'] = $deptObj->getDepartmentByCompany($companyId->id);

        if ($request->isMethod('post')) {

            $objAward = new Award();
            $userData = Auth::guard('company')->user();
            $getAuthCompanyId = Company::where('email', $userData->email)->first();
            $logedcompanyId = $getAuthCompanyId->id;
            $result = $objAward->addAwardData($request, $logedcompanyId);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Award Add Successfully.';
                $return['redirect'] = route('award-company');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/client.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Client.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'jquery.timepicker.css');
        $data['header'] = array(
            'title' => 'Client List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Client List' => route("client"),
                'Client Add' => 'Client-add'));

        return view('company.client.client-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
