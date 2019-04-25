<?php

namespace App\Http\Controllers\Company;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Award;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Department;
use App\Model\Notification;
use Auth;

class AwardController extends Controller {

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
            'title' => 'Award List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Award' => 'Award'));

        return view('company.award.award-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function award_add(Request $request) {

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

                //notification add
                $objNotification = new Notification();
                $awardName=$request->input('award')." is a new award.";
                $objEmployee = new Employee();
                $u_id=$objEmployee->getUseridById($request->input('employee'));
                $route_url="award";
                $ret = $objNotification->addNotification($u_id,$awardName,$route_url);

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
        $data['js'] = array('company/award.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Award.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'jquery.timepicker.css');
        $data['status'] = array('1' => 'one', '2' => 'two', '3' => 'three');
        $data['header'] = array(
            'title' => 'Award List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Award List' => route("award-company"),
                'Award' => 'Award-add'));

        return view('company.award.award-add', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser->id;
                $companyId = Company::select('id')->where('user_id', $userID)->first();
                $announmntObj = new Award;
                $AnnounmntList = $announmntObj->getAwardList($request, $companyId->id);
                echo json_encode($AnnounmntList);
                break;
            case'awardDetails':
                $result = $this->getAwardDetails($request->input('data'));
                break;
            case'deleteAward':
                $result = $this->deleteAward($request->input('data'));
                break;
        }
    }

    public function deleteAward($postData) {
        if ($postData) {
            $findAnnounmnt = Award::where('id', $postData['id'])->first();
            $result = $findAnnounmnt->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Record deleted successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#AwardDatatables').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function award_edit(Request $request,$id) {

        $session = $request->session()->all();
        $logindata = $session['logindata'][0];

        $companyId = Company::select('id')->where('user_id', $logindata['id'])->first();
        $data['getAllEmpOfCompany'] = Employee::where('company_id', $companyId->id)->get();
        $deptObj = new Department();
        $data['getDepartmentOfCompany'] = $deptObj->getDepartmentByCompany($companyId->id);

        if ($request->isMethod('post')) {
            $objAward = new Award();
            $ret = $objAward->editAward($request,$id);

            if ($ret) {
                $return['status'] = 'success';
                $return['message'] = 'Record Edited successfully.';
                $return['redirect'] = route('award-company');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Please add any one designation!';
            }

            echo json_encode($return);
            exit;
        }
        $data['award_detail'] = Award::where('id', $id)->first();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/award.js', 'jquery.form.min.js', 'jquery.timepicker.js');
        $data['funinit'] = array('Award.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css', 'jquery.timepicker.css');
        $data['status'] = array('1' => 'one', '2' => 'two', '3' => 'three');
        $data['header'] = array(
            'title' => 'Award List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Award List' => route("award-company"),
                'Award' => 'Award-add'));

        return view('company.award.award-edit', $data);
    }

    public function getAwardDetails($postData)
    {
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        $awardDetails = Award::select('award.*','emp.name as emp_name','department.department_name as dept_name')
                            ->join('employee as emp', 'award.employee_id', '=', 'emp.id')
                            ->join('department', 'award.department', '=', 'department.id')
                            ->where('award.id', $postData)
                            ->first();

        if($awardDetails){
            $awardDetails->date = date("d-m-Y", strtotime($awardDetails->date));
        }

        echo json_encode($awardDetails);
        exit;
    }

    public function downloadAttachment(Request $request,$file_name)
    {
        // echo "<pre>"; print_r($file_name); exit();
        $file = public_path(). "/uploads/award_attachment/".$file_name;
        if(file_exists($file))
        {
            // $headers = array(
            //           'Content-Type: application:image/png',
            //         );
            return Response::download($file,$file_name);
        }
        else
        {
            return redirect('company/award')->with('status', 'file not found!');
        }
    }
}
