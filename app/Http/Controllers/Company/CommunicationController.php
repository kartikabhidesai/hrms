<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\SendSMS;
use App\Model\Department;
use Auth;

class CommunicationController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function communication(Request $request) 
    {
        $session = $request->session()->all();
        
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => 'Communcation'));
        $empobj= new Employee();
        
         $userData = Auth::guard('company')->user();
       
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id; 
       // $data['empArray']=$empobj->employeelistforcommunication($logedcompanyId);
        
        return view('company.communication.communication', $data);
    }
    public function compose(Request $request) {
        
        $session = $request->session()->all();
        $companyId=$session['logindata']['0']['id'];
        $objEmployee= new Employee();
        $data['employeeList']=$objEmployee->getEmployeeList($companyId);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => 'Communcation',
                'Compose'=>'Compose'));
        return view('company.communication.compose', $data);
    }

   
}
