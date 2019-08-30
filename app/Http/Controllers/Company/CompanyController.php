<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Model\Announcement;
use App\Model\Company;
use App\Model\Task;
use App\Model\Ticket;
use App\Model\Employee;
use App\Model\Attendance;
use App\Model\Recruitment;
use App\Model\Leave;
use App\Model\NonWorkingDate;
use App\Model\Payroll;
use App\Model\CalendarEvent;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    public function __construct() {
        $this->middleware('company');
    }

    public function dashboard(Request $request) {
        $month= date('m');
        $year= date('Y');
        $session = $request->session()->all();
        $companyId=  Company::select('id')->where('user_id', $session['logindata'][0]['id'])->first();
        
        $objannousmentList =new Announcement();
        $data['annousmentList']= $objannousmentList->annousmentList($companyId['id']);
        
        $data['progressTask']=  Task::where('company_id', $companyId['id'])
                                ->where('task_status','1')
                                ->count();
        
        $data['completedTask']=  Task::where('company_id', $companyId['id'])
                                ->where('task_status','2')
                                ->count();
        
        $data['penddingTask']=  Task::where('company_id', $companyId['id'])
                                ->where('task_status','0')
                                ->count();
        
        $data['totalTask']=  Task::where('company_id', $companyId['id'])
                                ->count();
        
        $data['statusBar']=  Task::where('company_id', $companyId['id'])
                                ->where('task_status','1')
                                ->orderBy('id', 'desc')
                                ->limit(2)
                                ->get();
        
        $birthday= Employee::where('company_id', $companyId['id'])
                                ->where('date_of_birth', 'like', '%-'.$month.'-%')
                                ->where('date_of_birth', '>=', date('Y-m-d'))
                                ->count();
        
        $birth= Employee::where('company_id', $companyId['id'])
                                ->where('date_of_birth', 'like', '%-'.$month.'-%')
                                ->where('date_of_birth', '>=', date('Y-m-d'))
                                ->get()->first();
        
        $eventfirst = CalendarEvent::where('company_id', $companyId['id'])
                                ->where('event_date', 'like', '%-'.$month.'-%')
                                ->where('event_date', '>=', date('Y-m-d'))
                                ->orderBy('event_date', 'asc')
                                ->get()->first();
        $eventfirstnew = CalendarEvent::where('company_id', $companyId['id'])
                                ->where('event_date', '>=', date('Y-m-d'))
                                ->orderBy('event_date', 'asc')
                                ->get()->first();
        
        $data['upcomingevnt']=$eventfirstnew;
        
        $event = CalendarEvent::where('company_id', $companyId['id'])
                                ->where('event_date', 'like', '%-'.$month.'-%')
                                ->where('event_date', '>=', date('Y-m-d'))
                                ->count();
        
        $data['birthday']= $birthday + $event ;
        
        $data['overdueTask']= Task::where('company_id', $companyId['id'])
                                ->where('deadline_date', '<', date('Y-m-d'))
                                ->count();
        
        $data['salaryPayment']=Payroll::join('employee', 'employee.id', '=', 'pay_roll.employee_id')
                            ->where('employee.company_id', $companyId['id'])
                            ->where('pay_roll.month', $month-1)
                            ->where('pay_roll.year',$year)
                            ->sum('pay_roll.basic_salary');
        $data['otherPayment']=Payroll::where('employee.company_id', $companyId['id'])
                            ->join('employee', 'employee.id', '=', 'pay_roll.employee_id')
                            ->sum('pay_roll.over_time');
        $data['totalEmployee']= Employee::where('company_id', $companyId['id'])
                                ->count();
        
        $data['presentEmployee']= Employee::leftjoin('attendance', 'employee.id', '=', 'attendance.emp_id') 
                                            ->where('attendance.date',date('Y-m-d'))
                                            ->where('attendance.attendance','present')
                                            ->where('employee.company_id', $companyId['id'])
                                            ->count();
        
        $data['absentEmployee']= Employee::leftjoin('attendance', 'employee.id', '=', 'attendance.emp_id') 
                                            ->where('attendance.attendance','absent')
                                            ->where('attendance.date',date('Y-m-d'))
                                            ->where('employee.company_id', $companyId['id'])
                                            ->count();

        $data['recruitment'] = Recruitment::where('company_id',$companyId['id'])->where('status',0)->get()->count();
        $data['leaves'] = Leave::where('cmp_id',$companyId['id'])->where('start_date','>=',date('Y-m-d'))->get()->count();
        $data['pluginjs'] = array('plugins/slick/slick.min.js');
        $data['js'] = array('company/dashbord.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Dashboard.init()');
        $data['css'] = array('plugins/slick/slick.css','plugins/slick/slick-theme.css','plugins/jasny/jasny-bootstrap.min.css');
        $data['header'] = array(
            'title' => 'Dashboard',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        return view('company.dashboard', $data);
    }

}