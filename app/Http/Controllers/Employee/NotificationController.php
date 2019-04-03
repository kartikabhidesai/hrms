<?php

namespace App\Http\Controllers\Employee;

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
        $this->middleware('employee');
    }

    public function sentNotification(Request $request) 
    {

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

	public function notificationList(Request $request)
	{
		 
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/notification.js');
        $data['funinit'] = array('Notification.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'View Notification',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Sent Notification' => 'View Notification'));
        return view('company.notification.notification-list', $data);
	}
}
