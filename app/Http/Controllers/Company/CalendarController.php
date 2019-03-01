<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CalendarEvent;
use App\Model\Company;
use Auth;
use Route;

class CalendarController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('company');
    }

    public function index(Request $request)
    {
        $session = $request->session()->all();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/calendar.js');
        $data['funinit'] = array('Calendar.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Company',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard"),
                'Calendar' => 'Calendar'));
        return view('company.calendar.index', $data);
    }

    public function ajaxAction(Request $request)
    {
    	$action = $request->input('action');
    	$userData = Auth::guard('company')->user();
        $companyId = Company::where('email', $userData->email)->first();
        
        switch ($action) {
            case 'addNewEvent':
                $objNewEvent = new CalendarEvent();
                $newEvent = $objNewEvent->addNewEvent($request, $companyId->id);

                if ($newEvent) {
	                $return['status'] = 'success';
	                $return['message'] = 'New Event created successfully.';
	                $return['redirect'] = route('calendar');
	            } else {
	                $return['status'] = 'error';
	                $return['message'] = 'Something went wrong while creating new Event!';
	            }
                echo json_encode($return);
            exit;
            break;
    	}
    }
}
