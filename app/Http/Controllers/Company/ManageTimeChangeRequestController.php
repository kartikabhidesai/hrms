<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManageTimeChangeRequest;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
use Auth;
use Route;
class ManageTimeChangeRequestController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function timeChangeRequest(Request $request)
    {
    	$session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/timeChangeRequest.js');
        $data['funinit'] = array('TimeChangeRequest.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Time Change Request List',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Manage Time Change Request' => 'Manage Time Change Request'));
        return view('company.manage-time-change-request.request-list', $data);
    }
    
    public function ajaxaction(Request $request){
        
        $action=$request->input('action');
        switch ($action)
        {
                case 'getdatatable':
                    $companyId = Auth()->guard('company')->user()['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $datalist=$objManageList->companygetManageTimeChangeList($companyId);
                    echo json_encode($datalist);
                    break;
                
                case 'approveRequest':
                    $id=$request->input('data')['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $approveRequest=$objManageList->approveRequest($id);
                    if ($approveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Time chnage request approved';
                        $return['redirect'] = route('time-change-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
                    
               case 'disapproveRequest':
                    $id=$request->input('data')['id'];
                    $objManageList=new ManageTimeChangeRequest();
                    $disapproveRequest=$objManageList->disapproveRequest($id);
                    if ($disapproveRequest) {
                        $return['status'] = 'success';
                        $return['message'] = 'Time chnage request rejected';
                        $return['redirect'] = route('time-change-request');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;
                    break;
                    
        }
            
                
    }
}
