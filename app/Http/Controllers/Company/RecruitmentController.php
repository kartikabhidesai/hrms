<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Department;
use App\Model\Recruitment;
use Auth;
use Route;
use APP;
use PDF;
use App\User;
use App\Model\Users;
use Illuminate\Support\Facades\Input;

class RecruitmentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request) {
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Recruitment',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Recruitment' => 'Recruitment'));
        

        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();
        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId->id);
        $data['experince']=['0'=>'0-1','1'=>'1-3','2'=>'3-5','3'=>'5-10','4'=>'10+'];
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/recruitment.js','jquery.form.min.js');
        $data['funinit'] = array('Recruitment.init()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');

        return view('company.recruitment.recruitment-list', $data);
    }

    public function ajaxAction(Request $request) 
    {
        
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objRecruitment = new Recruitment();
                $demoList = $objRecruitment->getdatatable();
                echo json_encode($demoList);
            break;
            case 'deleteRecruitment':
                $result = $this->deleteRecruitment($request->input('data'));
                break;
            case 'getCompnanyRecruitmentList':
                $result = $this->getCompnanyRecruitmentList1();                
                break;

        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRecruitment(Request $request) {
        $session = $request->session()->all();
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();

        if ($request->isMethod('post')) {
            $data['recrutment'] = $request->input();
            $objRecruitment = new Recruitment();
            $demoList = $objRecruitment->addRecruitment($request, $companyId->id, $data);
            $file = 'recrutment'.time().'.pdf';
            // return view('company.recruitment.recruitment-list', $data);
            $pdf = PDF::loadView('company.recruitment.recrutment-pdf', compact('data'));
            return $pdf->download($file);

            // $objRecruitment = new Recruitment();
            // $ret = $objRecruitment->addRecruitment($request, $companyId->id);

            // if ($ret) {
            //     $return['status'] = 'success';
            //     $return['message'] = 'Recruitment created successfully.';
            //     $return['redirect'] = route('recruitment');
            // } else {
            //     $return['status'] = 'error';
            //     $return['message'] = 'Somethin went wrong while creating new training!';
            // }
            // echo json_encode($return);
            // exit;
        }

        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Recruitment',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Recruitment' => route("recruitment"),
                'Add Recruitment' => 'Recruitment'));
        

        
        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId->id);
        $data['experince']=['0'=>'0-1','1'=>'1-3','2'=>'3-5','3'=>'5-10','4'=>'10+'];
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/recruitment.js','jquery.form.min.js');
        $data['funinit'] = array('Recruitment.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');

        return view('company.recruitment.recruitment-add', $data);
    }

    public function deleteRecruitment($postData) {
        if ($postData) {
            $result = Recruitment::where('id', $postData['id'])->delete();

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Recruitment delete successfully.';
                $return['jscode'] = "setTimeout(function(){
                        $('#deleteModel').modal('hide');
                        $('#recruitmentTable').DataTable().ajax.reload();
                    },1000)";
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function editRecruitment(Request $request,$id) {
        $data['details'] = Recruitment::find($id);
        $session = $request->session()->all();
        $userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();
        if ($request->isMethod('post')) {
            $objRecruitment = new Recruitment();
            $res = $objRecruitment->editRecruitment($request,$id,$companyId->id);
            if ($res) {
                $return['status'] = 'success';
                $return['message'] = 'Recruitment updated successfully.';
                $return['redirect'] = route('recruitment');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Recruitment',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Recruitment' => route("recruitment"),
                'Edit Recruitment' => 'Recruitment'));
        
        $objDepart = new Department();
        $data['department'] = $objDepart->getDepartment($companyId->id);
        $data['experince']=['0'=>'0-1','1'=>'1-3','2'=>'3-5','3'=>'5-10','4'=>'10+'];
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/recruitment.js','jquery.form.min.js');
        $data['funinit'] = array('Recruitment.add()');
        $data['css'] = array('plugins/jasny/jasny-bootstrap.min.css');
        return view('company.recruitment.recruitment-edit', $data);
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
