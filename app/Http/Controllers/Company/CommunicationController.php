<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Communication;
use Auth;
use Response;

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

        $empobj = new Employee();
        $userData = Auth::guard('company')->user();
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id; 
        $communicationobj = new Communication();
        $data['cmpMails'] = $communicationobj->companyEmailsForCommunication($logedcompanyId);
        
        return view('company.communication.communication', $data);
    }

    public function compose(Request $request)
    {
        $session = $request->session()->all();
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();

        if ($request->isMethod('post')) {
            // print_r($request->all());exit;
            $objCommunication = new Communication();
            $result = $objCommunication->addNewCommunication($request, $companyId->id);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'New Communication Email sent successfully.';
                $return['redirect'] = route('communication');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }

        $objEmployee = new Employee();
        $data['employeeList'] = $objEmployee->getEmployeeList($companyId->id);
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/communication.js','ckeditor/ckeditor.js','plugins/summernote/summernote.min.js', 'jquery.form.min.js');
        $data['funinit'] = array('Communication.init()');
        $data['css'] = array('plugins/summernote/summernote.css','plugins/summernote/summernote-bs3.css');
        $data['header'] = array(
            'title' => 'Communcation',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Communcation' => route("communication"),
                'Compose' => 'Compose'));

        return view('company.communication.compose', $data);
    }

    public function mailDetail(Request $request, $id)
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
                'Communcation' => route("communication"),
                'Communcation Detail' => 'Communcation Detail'));

        $empobj = new Employee();
        
        $userData = Auth::guard('company')->user();
       
        $getAuthCompanyId = Company::where('email', $userData->email)->first();
        $logedcompanyId = $getAuthCompanyId->id;
        $communicationobj = new Communication();
        $data['cmpMailDetail'] = $communicationobj->companyEmailCommunicationDetail($logedcompanyId, $id);
        
        return view('company.communication.communication-detail', $data);
    }

    public function downloadAttachment(Request $request, $fileName)
    {
        $file_path = public_path() .'/uploads/communication/'. $fileName;
        if (file_exists($file_path))
        {
            // Download File
            return Response::download($file_path, $fileName, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }
}
