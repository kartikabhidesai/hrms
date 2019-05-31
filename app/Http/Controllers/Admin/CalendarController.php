<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CalendarEvent;
use App\Model\Users;
use App\Model\NonWorkingDate;
use Auth;
use Route;

class CalendarController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/calendar.js','jquery.timepicker.js');
        $data['funinit'] = array('Calendar.init()');
        $data['css'] = array('jquery.timepicker.css');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Calendar' => 'Calendar'));
        return view('admin.calendar.index', $data);
    }

    public function ajaxAction(Request $request)
    {
        $action = $request->input('action');
    	$userData = Auth::guard('admin')->user();
        $userId = Users::where('email', $userData->email)->first();
        // print_r($userId);
        // exit;
    	
        switch ($action) {
            case 'addNewEvent':
                $objNonWorkingDate = new NonWorkingDate();
                $resultNonWorkingDate = $objNonWorkingDate->getCompanyNonWorkingDateArrayList($userId->id);
            
                if(in_array(date('Y-m-d',strtotime($request->date)), $resultNonWorkingDate)) {
                    $return['status'] = 'error';
                    $return['message'] = $request->date. ' is Non Working Date';
                }else{
                    $objNewEvent = new CalendarEvent();
                    $newEvent = $objNewEvent->addNewEvent($request, $userId->id);

                    if ($newEvent) {
                        $return['status'] = 'success';
                        $return['message'] = 'New Event created successfully.';
                        $return['redirect'] = route('admin-calendar');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something went wrong while creating new Event!';
                    }
                }
                echo json_encode($return);
            exit;
            break;
    	}
    }

    public function getEvent(Request $request)
    {
        $session = $request->session()->all();
        $userData = Auth::guard('admin')->user();
        $getAuthUserId = Users::where('email', $userData->email)->first();
        $logedUserId = $getAuthUserId->id; 
        $eventobj = new CalendarEvent();
        $data['calenderEventList'] = $eventobj->getCompanyEvent($logedUserId);
        return json_encode($data['calenderEventList']);
    }
}
