<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
use App\Model\Attendance;
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
        $data['date']="";
    	$userid = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userid)->get();
    	if (!empty($request->get('departentId'))) {
            $data['departentId'] = $request->get('departentId');
            $data['date'] = $request->get('date');
    		if($request->get('departentId') == 'all') {
                $data['departmentname']="All Department";
                $data['getEmployees'] = Employee::select('Employee.name','Employee.id','Employee.user_id','attendance.reason','attendance.attendance')
                                                ->join('department', 'employee.department', '=', 'department.id')
                                                ->join('comapnies', 'department.company_id', '=', 'comapnies.id')   
                                                ->leftjoin('attendance', 'employee.user_id', '=', 'attendance.user_id')   
                                                ->where('comapnies.user_id', $userid)
                                                ->get();
    		} else {
                $departmentname = Department::select('id', 'department_name')->where('id', $data['departentId'])->first();
                $data['getEmployees'] = Employee::where('department', $departmentname->id)->get();  
                $data['departmentname'] = $departmentname[0]['department_name'];
    		}
    	}
        if($request->isMethod('post')) {
            $objAttendance = new Attendance;
            $result=$objAttendance->saveAttendance($request);
             if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Attendance created successfully.';
                $return['redirect'] = route('daily-attendance');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit;
        }
        $data['detail'] = Department::where('company_id', $companyId[0]['id'])->get();
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

    public function attendanceReport(Request $request) 
    {
    	$userId = $this->loginUser->id;
        $companyId = Company::select('id')->where('user_id', $userId)->first();
        $data['detail'] = Department::where('company_id', $companyId['id'])->get();

        if ($request->isMethod('post')) {
        	dd('x');
        }

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/attendance_report.js', 'jquery.form.min.js');
        $data['funinit'] = array('AttendanceReport.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Attendance Report',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Attendance Report' => 'Attendance Report'));
      
        return view('company.attendance.attendance-report', $data);
    }
    
}
