<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Employee;
use App\Model\Company;
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
            $data['departentId']=$request->get('departentId');
            $data['date']=$request->get('date');
    		if($request->get('departentId') == 'all') {
                    $data['departmentname']="All Department";
                    $data['getEmployees'] = Employee::select('Employee.name','Employee.id')
                            ->join('department', 'employee.department', '=', 'department.id')
                            ->join('comapnies', 'department.company_id', '=', 'comapnies.id')   
                            ->where('comapnies.user_id', $userid)
                            ->get();
    		} else {
                    $departmentname = Department::select('department_name')->where('id', $data['departentId'])->get();
                    $data['getEmployees'] = Employee::where('department', $request->department_id)->get();  
                    $data['departmentname']=$departmentname[0]['department_name'];
    		}
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
    
}
