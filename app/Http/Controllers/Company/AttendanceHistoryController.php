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

class AttendanceHistoryController extends Controller
{
	public function __construct() {
		parent::__construct();
        $this->middleware('company');
    }

    public function attendanceHistory()
    {
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('company/attendance_history.js', 'jquery.form.min.js','plugins/daterangepicker/daterangepicker.js');
        $data['funinit'] = array('attendanceHistory.init()');
        $data['css'] = array('');
        $data['header'] = array(
            'title' => 'Manage Attendance History',
            'breadcrumb' => array(
                'Home' => route("company-dashboard"),
                'Manage Attendance History' => 'Manage Attendance History'));
      
        return view('company.attendance-history.manage-attendance-history', $data);
    }
    
}
