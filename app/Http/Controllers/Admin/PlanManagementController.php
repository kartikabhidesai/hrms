<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\PlanManagement;
use Auth;
use Config;

class PlanManagementController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/systemsetting.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('SysSetting.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Plan-Management',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Plan-Management-list' => 'Plan-Management-list'));

        return view('admin.plan-management.plan-management-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPlan(Request $request) {

        if ($request->isMethod('post')) {
            $planObj = new PlanManagement();
            $result = $planObj->addPlan_Management($request);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'plan Add Successfully.';
                $return['redirect'] = route('plan-management');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/planmanage.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Plan.add()');
        $data['css'] = array('');
        $data['duration'] = array('1' => 'Month', '2' => '3 Month', '3' => '6 Month', '4' => 'Year',);
        $data['header'] = array(
            'title' => 'System-Setting',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'System-setting' => 'System-setting'));

        return view('admin.plan-management.plan-management-add', $data);
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
