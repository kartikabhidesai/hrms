<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\Model\Company;
use App\Model\SendSMS;
use App\Model\Tax;
use App\Model\Department;

class NotificationController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function sentNotification(Request $request) 
    {
        $session = $request->session()->all();
       
        $userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->first();
        $objTax = new Tax();
        $data['taxResult'] = $objTax->getTax($companyId->id);

        if($request->isMethod('post')) {
            $objTax = new Tax();
            $result = $objTax->editTax($request,$companyId->id);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Tax Set Successfully.';
                $return['redirect'] = route('set-tax');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong!';
            }
            echo json_encode($return);
            exit;
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/notification.js');
        $data['funinit'] = array('Notification.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Sent Notification',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Sent Notification' => 'Sent Notification'));
        return view('company.notification.notification-add', $data);
    }

	public function notificationList($value='')
	{
		
	}
}
