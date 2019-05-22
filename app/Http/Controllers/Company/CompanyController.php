<?php

namespace App\Http\Controllers\Company;
use App\User;
use App\Model\Users;
use App\Model\Announcement;
use App\Model\Company;
use App\Model\Task;
use App\Model\Ticket;
use App\Model\Employee;
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
        
        $data['statusBar']=  Task::where('company_id', $companyId['id'])
                                ->where('task_status','1')
                                ->orderBy('id', 'desc')
                                ->limit(2)
                                ->get();
        
        
        $data['totalTicket']=  Ticket::where('company_id', $companyId['id'])
                                ->count();
        
        $data['birthday']= Employee::where('company_id', $companyId['id'])
                                ->where('date_of_birth', 'like', '%-'.$month.'-%')
                                ->count();
        
        
        $data['header'] = array(
            'title' => 'Dashboard',
            'breadcrumb' => array(
                'Home' => route("admin-dashboard")));
        return view('company.dashboard', $data);
    }

}