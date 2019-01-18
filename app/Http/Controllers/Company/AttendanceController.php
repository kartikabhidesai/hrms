<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use Auth;
use Route;

class AttendanceController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function dailyAttendance(Request $request) 
    {
    	$companyId = $this->loginUser->id;
    	if ($request->isMethod('post')) {
    		dd($request->all());
    		if($request->department_id == 'all') {
    			$getEmployees = Employee::where('company_id', $companyId)->get();
    		} else {
    			$getEmployees = Employee::where('department_id', $request->department_id)->get();
    		}
    	}        
        
        $data['detail'] = Department::where('company_id', $companyId)->get();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/daily_attendance.js', 'jquery.form.min.js');
        $data['funinit'] = array('DailyAttendance.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Daily Attendance',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Daily Attendance' => 'Daily Attendance'));
        return view('company.attendance.daily-attendance', $data);
    }
    
}
