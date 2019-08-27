<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Notification;
use App\Model\Users;
use App\Model\Employee;
use App\Model\UserNotificationType;

class NotificationController extends Controller
{
    function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/notification.js');
        $data['funinit'] = array('Notification.init()');
        $data['css'] = array('');
        $data['header'] = array(
                'title' => 'Company',
                'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Notification' => 'Notification'));
        return view('admin.notification.list', $data);
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $userID = $this->loginUser;
                $objEmploye=new Employee();
                $objNotification = new Notification();
                $demoList = $objNotification->getNotificationDatatable($userID->id);
                echo json_encode($demoList);
                break;
        }
    }
}
