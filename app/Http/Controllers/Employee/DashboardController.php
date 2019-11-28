<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Company;
use App\Model\Employee;
use App\Model\Leave;
use App\Model\ManageTimeChangeRequest;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\Task;
use App\Model\Advancesalary;
use App\Model\Announcement;
use App\Model\Notification;
use App\Model\NotificationMaster;
use Config;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }

    public function dashboard(Request $request) {
        
        $data['task_progress'] = Config::get('constants.task_progress');
        $data['task_status'] = ['In Progress', 'Pending', 'Complete'];
        $session = $request->session()->all();
        
        $data['login_user'] = $session['logindata'][0];       
        $logged_in_user_id = $session['logindata'][0]['id'];
        $emp_id= Employee::select("id")->where('user_id',$logged_in_user_id)->get();
        $data['totalTask'] = Task::where('employee_id',$emp_id[0]->id)->count();
        $data['totalCompletedTask'] = Task::where('employee_id',$emp_id[0]->id)->where('task_status',3)->count();
        if ($request->isMethod('post')) {
            
            $session = $request->session()->all();
            $userID=$session['logindata'][0]['id'];
            $empId = Employee::select('id','name','company_id')->where('user_id', $userID)->first();
            $objEmploye = new Task();
            $res = $objEmploye->updateTaskDetailEmp($request, $empId->id);
            if ($res) {
                $objCompany = new Company();
                $u_id=$objCompany->getUseridById($empId->company_id);

                $notificationMasterId=15;
                $objNotificationMaster = new NotificationMaster();
                $NotificationUserStatus=$objNotificationMaster->checkNotificationUserStatus($u_id,$notificationMasterId);
                
                if($NotificationUserStatus==1)
                {
                    $taskRequestName=$empId->name." update the task.";
                    
                    $route_url="task-list";
                    $objNotification = new Notification();
                    $ret = $objNotification->addNotification($u_id,$taskRequestName,$route_url,$notificationMasterId);
                }

                $return['status'] = 'success';
                $return['message'] = 'Task updated successfully.';
                $return['redirect'] = route('employee-dashboard');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something went wrong while creating new task!';
            }
            echo json_encode($return);

            exit();
        }
        
        
        $leave= Leave::select("*")->leftjoin('employee', 'leaves.emp_id', '=', 'employee.id')
                    ->leftjoin('users', 'employee.user_id', '=', 'users.id')
                    ->where('users.id',$logged_in_user_id)
                    ->get()->count();
        $manageTimeChangeRequest= ManageTimeChangeRequest::select("*")->leftjoin('employee', 'time_change_requests.employee_id', '=', 'employee.id')
                    ->leftjoin('users', 'employee.user_id', '=', 'users.id')
                    ->where('users.id',$logged_in_user_id)
                    ->get()->count();
        $data['totalLeave']=$manageTimeChangeRequest + $leave;
        $remaningDay= Employee::select("payroll_setting.payment_date")->leftjoin('payroll_setting', 'employee.joining_salary', '=', 'payroll_setting.id')
                              ->where('employee.user_id',$logged_in_user_id)
                              ->get();
        $temp_data=substr($remaningDay[0]->payment_date, 0, 2);
        $today=date("d");
        $month=date("m");
        $year=date("Y");
        if($today > $temp_data){
            $month++;
            $startTimeStamp = time(); // or your date as well
            $temp=date("Y-m-d",strtotime($year."-".$month."-".$temp_data));
            $endTimeStamp = strtotime($temp);
            $timeDiff = abs($endTimeStamp - $startTimeStamp);

            $numberDays = $timeDiff/86400;
//            $d=cal_days_in_month(CAL_GREGORIAN,$month+1,$year);
            $data['diff']= round($numberDays);
            
        }else{
            $data['diff']=$temp_data-$today;
        }
        
        $logged_in_user = Employee::select('*')->where('user_id', $logged_in_user_id)->first();
        $objAnnouncementList =new Announcement();
        $announcementList = $objAnnouncementList->annousmentList($logged_in_user['company_id']);
        $latest_task = Task::select('*')->where('employee_id',$logged_in_user->id)->orderBy('id','desc')->first();
        $latest_advance_salary_request = Advancesalary::select('*')->where('employee_id',$logged_in_user->id)->orderBy('id','desc')->first();
       
        $data['latest_task'] = @$latest_task;
        $data['employee_data'] = @$logged_in_user;
        $data['advance_salary_request'] = @$latest_advance_salary_request;
        $data['announcementList'] = $announcementList;
        $data['pluginjs'] = array('plugins/slick/slick.min.js');
        $data['js'] = array('employee/dashbord.js', 'ajaxfileupload.js','jquery.form.min.js');
        $data['funinit'] = array('Dashboard.init()');
        $data['css'] = array('plugins/slick/slick.css','plugins/slick/slick-theme.css','plugins/jasny/jasny-bootstrap.min.css');
        $data['detail'] = $this->loginUser;
        $data['header'] = array(
            'title' => 'Employee Dashboard',
            'breadcrumb' => array(
                'Home' => route("employee-dashboard"),
                'Dashboard' => 'Dashboard'));
        return view('employee.dashboard', $data);
    }

    public function employeeTaskComment(Request $request)
    {
        $objTask = Task::find($request->task_id);
        $objTask->about_task = $request->task_comment;
        if($objTask->save())
        {
            return redirect()->route('employee-dashboard')->with(['status'=>'success','message'=>'Task Comment updated successfully.']);
        }
        else
        {
            return redirect()->back()->with(['status'=>'failed','message'=>'Something Went wrong']);
        }
    }

    public function employeeUploadFile(Request $request)
    {
        $name = '';
        if($request->file()){
            $image = $request->file('upload_file');
            $name = 'emp_tasks_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/tasks/');
            $image->move($destinationPath, $name);    
        }

        $objTask = Task::find($request->task_id);
        $objTask->file = $name;
        if ($objTask->save()) 
        {
            return redirect()->route('employee-dashboard')->with(['status'=>'success','message'=>'Task Comment updated successfully.']);
        }
        else
        {
            return redirect()->back()->with(['status'=>'failed','message'=>'Something Went wrong']);
        }
    }

    public function employeeSetStatus(Request $request)
    {
        $objTask = Task::find($request->task_id);
        $objTask->task_status = $request->task_status;
        if($objTask->save())
        {
            return redirect()->route('employee-dashboard')->with(['status'=>'success','message'=>'Task Comment updated successfully.']);
        }
        else
        {
            return redirect()->back()->with(['status'=>'failed','message'=>'Something Went wrong']);
        }
    }   
}
