<?php

namespace App\Http\Controllers\Employee;

use App\User;
use App\Model\Users;
use App\Model\Company;
use App\Model\Employee;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use App\Model\Task;
use App\Model\Advancesalary;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('employee');
    }

    public function dashboard(Request $request) {

        //$logged_in_user=Auth::guard('employee')->user()->id;
        $session = $request->session()->all();
        $data['login_user'] = $session['logindata'][0];
        $logged_in_user_id = $session['logindata'][0]['id'];
        $logged_in_user = Employee::select('*')->where('user_id', $logged_in_user_id)->first();

        $latest_task = Task::select('*')->where('employee_id',$logged_in_user->id)->orderBy('id','desc')->first();
        $latest_advance_salary_request = Advancesalary::select('*')->where('employee_id',$logged_in_user->id)->orderBy('id','desc')->first();

        $data['latest_task'] = @$latest_task;
        $data['employee_data'] = @$logged_in_user;
        $data['advance_salary_request'] = @$latest_advance_salary_request;
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('employee/dashbord.js');
        $data['funinit'] = array('Dashboard.init()');
        $data['css'] = array('');
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
