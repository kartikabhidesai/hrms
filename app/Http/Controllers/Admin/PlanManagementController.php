<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\PlanManagement;
use App\Model\PlanFeature;
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
        $data['js'] = array('admin/planmanage.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Plan.init()');
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

        $pfObj = new PlanFeature();
        $plan_features = $pfObj->getPlanFeatures();

        $data['plan_features'] = $plan_features;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/planmanage.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Plan.add()');
        $data['css'] = array('');
        $data['duration'] = array('1' => 'Month', '2' => '3 Month', '3' => '6 Month', '4' => 'Year',);
        $data['header'] = array(
            'title' => 'Add New Plan',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Plan List' => route("plan-management"),
                'Add New Plan' => 'Add New Plan'));

        return view('admin.plan-management.plan-management-add', $data);
    }

    public function editPlan(Request $request,$id) { 

        if ($request->isMethod('post')) {

            $planObj = new PlanManagement();
            $result = $planObj->updatePlan_Management($request,$id);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Plan Updated Successfully.';
                $return['redirect'] = route('plan-management');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $planObj = new PlanManagement();
        $plan_detail = $planObj->editPlan_Management($id);

        $pfObj = new PlanFeature();
        $plan_features = $pfObj->getPlanFeatures();

        $data['plan_detail'] = $plan_detail;
        $data['plan_features'] = $plan_features;
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

        return view('admin.plan-management.plan-management-edit', $data);
    }

    public function ajaxAction(Request $request) 
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objPlanManagement = new PlanManagement();
                $PlanManagementList = $objPlanManagement->getPlanManageDatatable();
                echo json_encode($PlanManagementList);
                break;
            case 'deletePlan':
                $result = $this->deletePlan($request->input('data'));
                break;
        }
    }

    public function deletePlan($postData) {
        if ($postData) {
            
            $result = PlanManagement::where('id', $postData['id'])->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Plan delete successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#plan-management-datatable').DataTable().ajax.reload();
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
