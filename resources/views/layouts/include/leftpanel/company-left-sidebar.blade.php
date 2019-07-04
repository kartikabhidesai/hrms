@php
$currentRoute = Route::current()->getName();
$session = Session::all();
$roles = Session::get('userRole');
$roles  = array_values($roles);

if (!empty(Auth()->guard('admin')->user())) {
$data = Auth()->guard('admin')->user();
}
if (!empty(Auth()->guard('company')->user())) {
$data = Auth()->guard('company')->user();
}
if (!empty(Auth()->guard('employee')->user())) {
$data = Auth()->guard('employee')->user();
}

$filename= url('uploads/client/'.$data['user_image']);
$file_headers = @get_headers($filename);
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        @if($file_headers[0] == 'HTTP/1.1 200 OK')
                        <img class="img-circle" width="50" src="{{ asset('uploads/client/'.$data['user_image']) }}" alt="User's Profile Picture">
                        @else
                        <img class="img-circle" width="50" src="{{ asset('img/profile_small.jpg') }}" alt="User's Profile Picture">
                        @endif
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="text-muted text-xs block"><strong class="font-bold"> {{ $session['logindata'][0]['name'] }} </strong> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('update-profile') }}">Update Profile</a></li>
                        <li><a href="{{ route('change-password') }}">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                     HRMS
                </div>
            </li>
            @if($roles == NULL)
            <li class="{{ ($currentRoute == 'company-dashboard' ? 'active' : '') }}">
                <a href="{{ route('company-dashboard') }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            
            <li class="{{ ($currentRoute == 'employee-add' || $currentRoute == 'employee-edit' || $currentRoute == 'employee-list'  ? 'active' : '') }}">
                <a href="{{ route('employee-list') }}"><i class="fa fa-user"></i> <span class="nav-label">Employee</span></a>
            </li>

            <li class="{{ ($currentRoute == 'department-list' || $currentRoute == 'department-add' || $currentRoute == 'department-edit'  ? 'active' : '') }}">
                <a href="{{ route('department-list') }}"><i class="fa fa-address-card"></i>
                    <span class="nav-label">Department</span></a>
            </li> 
            
            <li class="{{ ( $currentRoute == 'payroll-setting' || $currentRoute == 'campany-advance-salary-request' || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }} {{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Salary</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <li class="{{ ($currentRoute == 'payroll-list' || $currentRoute == 'payroll-emp-detail' || $currentRoute == 'payroll-add' || $currentRoute == 'payroll-edit'  ? 'active' : '') }}">
                        <a href="{{ route('payroll-list') }}"><i class="fa fa-money"></i>
                            <span class="nav-label">Payroll</span></a>
                    </li>
                    <li class="{{ ($currentRoute == 'pay-slip' ? 'active' : '') }}">
                        <a href="{{ route('pay-slip') }}"><i class="fa fa-history"></i>
                            <span class="nav-label">Pay Slip</span></a>
                    </li>
                    <li class="{{ ( $currentRoute == 'campany-advance-salary-request'  || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }}">
                        <a href="{{ route('campany-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Advance Salary Request</span></a>
                    </li>
                    
                    <li class="{{ ( $currentRoute == 'payroll-setting'   ? 'active' : '') }}">
                        <a href="{{ route('payroll-setting') }}"><i class="fa fa-cog" ></i> <span class="nav-label">Payroll Setting</span></a>
                    </li>
                    
<!--                    <li class="{{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                        <a href="{{ route('approved-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Approved Advance Salary</span></a>
                    </li>-->
                </ul>
            </li>


            <li class="{{ ($currentRoute == 'daily-attendance' ? 'active' : '') }} {{ ($currentRoute == 'attendance-report' ? 'active' : '') }} {{ ($currentRoute == 'time-change-request' ? 'active' : '') }} {{ ($currentRoute == 'manage-attendance-history' ? 'active' : '') }}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Attendance</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($currentRoute == 'daily-attendance' ? 'active' : '') }}">
                        <a href="{{ route('daily-attendance') }}"><i class="fa fa-thumb-tack"></i>
                            <span class="nav-label">Daily Attendance</span></a>
                    </li>

                    <li class="{{ ($currentRoute == 'attendance-report' ? 'active' : '') }}">
                        <a href="{{ route('attendance-report') }}"><i class="fa fa-bar-chart"></i>
                            <span class="nav-label">Attendance Report</span></a>
                    </li>

                    <li class="{{ ($currentRoute == 'manage-attendance-history' ? 'active' : '') }}">
                        <a href="{{ route('manage-attendance-history') }}"><i class="fa fa-envelope"></i>
                            <span class="nav-label">Manage Attendance History</span></a>
                    </li>

                    <li class="{{ ($currentRoute == 'time-change-request' ? 'active' : '') }}">
                        <a href="{{ route('time-change-request') }}"><i class="fa fa-envelope"></i>
                            <span class="nav-label">Manage Time Change Request</span></a>
                    </li>
                </ul>
            </li>

            <li class="{{ ($currentRoute == 'sms-list' ? 'active' : '') }} {{ ($currentRoute == 'new-sms' ? 'active' : '') }}">
                <a href="{{ route('sms-list') }}"><i class="fa fa-envelope"></i>
                    <span class="nav-label">Send SMS</span></a>
            </li> 

            <li class="{{ ($currentRoute == 'communication' ? 'active' : '') }} {{ ($currentRoute == 'compose' ? 'active' : '') }} {{ ($currentRoute == 'mail-detail' ? 'active' : '') }} {{ ($currentRoute == 'mail-detail/*' ? 'active' : '') }}">
                <a href="{{ route('communication') }}"><i class="fa fa-history"></i>
                    <span class="nav-label">Communication</span></a>
            </li> 

            <li class="{{ ($currentRoute == 'add-task' || $currentRoute == 'task-list' ? 'active' : '') }}">
                <a href="{{ route('task-list') }}"><i class="fa fa-tasks"></i>
                    <span class="nav-label">Task List</span></a>
            </li>

            <li class="{{ ($currentRoute == 'sent-notification' || $currentRoute == 'notification-list' ? 'active' : '') }}">
                <a href="{{ route('sent-notification') }}"><i class="fa fa-bell"></i>
                    <span class="nav-label">Notification</span></a>
            </li>

            <li class="{{ ($currentRoute == 'calendar' ? 'active' : '') }}">
                <a href="{{ route('calendar') }}"><i class="fa fa-calendar"></i>
                    <span class="nav-label">Calendar</span></a>
            </li>

            <li class="{{ ($currentRoute == 'performance' ||  $currentRoute == 'performance-emp-detail' || $currentRoute == 'employee-performance-list' || $currentRoute == 'performance-emp-detail/*' ? 'active' : '') }}">
                <a href="{{ route('performance') }}"><i class="fa fa-user"></i>
                    <span class="nav-label">Performance</span></a>
            </li>

            <li class="{{ ($currentRoute == 'ticket-list' || $currentRoute == 'add-ticket' ? 'active' : '') }}">
                <a href="{{ route('ticket-list') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Tickets</span></a>
            </li>

            <li class="{{ ($currentRoute == 'training' || $currentRoute == 'add-training' ? 'active' : '') }}">
                <a href="{{ route('training') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Training</span></a>
            </li>


            <!-- <li class="{{ ($currentRoute == 'recruitment' || $currentRoute == 'recruitment' ? 'active' : '') }}">
                <a href="{{ route('recruitment') }}"><i class="fa fa-empire"></i>
                <span class="nav-label">Recruitement</span></a>
            </li> -->

            <li class="{{ ($currentRoute == 'recruitment' || $currentRoute == 'recruitment-add' ? 'active' : '') }}">
                <a href="{{ route('recruitment') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Recruitment</span></a>
            </li>

            <li class="{{ ($currentRoute == 'announcement' || $currentRoute == 'announcement-add' ? 'active' : '') }}">
                <a href="{{ route('announcement') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Announcement</span></a>
            </li>

            <li class="{{ ($currentRoute == 'award' ? 'active' : '') }}">
                <a href="{{ route('award-company') }}"><i class="fa fa-bullhorn"></i>
                    <span class="nav-label">Award</span></a>
            </li>
            
            <li class="{{ ($currentRoute == 'report-list' || $currentRoute == 'task-report' || $currentRoute == 'ticket-report' || $currentRoute == 'client-report' || $currentRoute == 'transaction-report' || $currentRoute == 'holiday-report' ? 'active' : '') }}">
                <a href="{{ route('report-list') }}"><i class="fa fa-bullhorn"></i>
                    <span class="nav-label">Report</span></a>
            </li>
            
            <li class="{{ ($currentRoute == 'system-setting' || $currentRoute == 'system-setting' ? 'active' : '') }} {{ ($currentRoute == 'working-day-setting' ? 'active' : '') }} {{ ($currentRoute == 'leave-category' ? 'active' : '') }}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Setting</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($currentRoute == 'system-setting' || $currentRoute == 'system-setting' ? 'active' : '') }}">
                        <a href="{{ route('system-setting') }}"><i class="fa fa-cogs"></i>
                            <span class="nav-label">System Setting</span></a>
                    </li>

                    <li class="{{ ($currentRoute == 'working-day-setting' ? 'active' : '') }}">
                        <a href="{{ route('working-day-setting') }}"><i class="fa fa-bullhorn"></i>
                            <span class="nav-label">Working Day Setting</span></a>
                    </li>

                    <li class="{{ ($currentRoute == 'leave-category' ? 'active' : '') }}">
                        <a href="{{ route('leave-category') }}"><i class="fa fa-bullhorn"></i>
                            <span class="nav-label">Leave Category</span></a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ ($currentRoute == 'client' ? 'active' : '') }}">
                <a href="{{ route('client') }}"><i class="fa fa-users"></i>
                    <span class="nav-label">Client</span></a>
            </li>
            
            <li class="{{ ($currentRoute == 'chat' ? 'active' : '') }}">
                <a href="{{ route('chat') }}"><i class="fa fa-comments"></i>
                    <span class="nav-label">Chat</span></a>
            </li>
            
            <li class="{{ ($currentRoute == 'company-add-role' || $currentRoute == 'company-edit-role' || $currentRoute == 'company-role-list' ? 'active' : '') }}">
                <a href="{{ route('company-role-list') }}"><i class="fa  fa-american-sign-language-interpreting"></i>
                <span class="nav-label">Role</span></a>
            </li>
            @else
                <li class="{{ ($currentRoute == 'company-dashboard' ? 'active' : '') }}">
                    <a href="{{ route('company-dashboard') }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                
                

                @if(in_array(12, $roles) || in_array(13, $roles) || in_array(14, $roles) || in_array(15, $roles))
                <li class="{{ ( $currentRoute == 'campany-advance-salary-request' || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }} {{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Salary</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        
                        @if(in_array(12, $roles))
                        <li class="{{ ($currentRoute == 'payroll-list' || $currentRoute == 'payroll-emp-detail' || $currentRoute == 'payroll-add' || $currentRoute == 'payroll-edit'  ? 'active' : '') }}">
                            <a href="{{ route('payroll-list') }}"><i class="fa fa-money"></i>
                                <span class="nav-label">Payroll</span></a>
                        </li>
                        @endif
                        
                        @if(in_array(13, $roles))
                        <li class="{{ ($currentRoute == 'pay-slip' ? 'active' : '') }}">
                            <a href="{{ route('pay-slip') }}"><i class="fa fa-history"></i>
                                <span class="nav-label">Pay Slip</span></a>
                        </li>
                        @endif
                        @if(in_array(14, $roles))
                        <li class="{{ ( $currentRoute == 'campany-advance-salary-request'  || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }}">
                            <a href="{{ route('campany-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Advance Salary Request</span></a>
                        </li>
                        @endif
                        @if(in_array(15, $roles))
                        <li class="{{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                            <a href="{{ route('approved-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Approved Advance Salary</span></a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                
                @if(in_array(16, $roles) || in_array(17, $roles) || in_array(18, $roles) || in_array(19, $roles))
                        <li class="{{ ($currentRoute == 'daily-attendance' ? 'active' : '') }} {{ ($currentRoute == 'attendance-report' ? 'active' : '') }} {{ ($currentRoute == 'time-change-request' ? 'active' : '') }} {{ ($currentRoute == 'manage-attendance-history' ? 'active' : '') }}">
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Attendance</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array(16, $roles))
                                <li class="{{ ($currentRoute == 'daily-attendance' ? 'active' : '') }}">
                                    <a href="{{ route('daily-attendance') }}"><i class="fa fa-thumb-tack"></i>
                                        <span class="nav-label">Daily Attendance</span></a>
                                </li>
                            @endif
                            @if(in_array(17, $roles))
                                <li class="{{ ($currentRoute == 'attendance-report' ? 'active' : '') }}">
                                    <a href="{{ route('attendance-report') }}"><i class="fa fa-bar-chart"></i>
                                        <span class="nav-label">Attendance Report</span></a>
                                </li>
                            @endif
                            @if(in_array(18, $roles))
                                <li class="{{ ($currentRoute == 'manage-attendance-history' ? 'active' : '') }}">
                                    <a href="{{ route('manage-attendance-history') }}"><i class="fa fa-envelope"></i>
                                        <span class="nav-label">Manage Attendance History</span></a>
                                </li>
                            @endif
                            @if(in_array(19, $roles))
                                <li class="{{ ($currentRoute == 'time-change-request' ? 'active' : '') }}">
                                    <a href="{{ route('time-change-request') }}"><i class="fa fa-envelope"></i>
                                        <span class="nav-label">Manage Time Change Request</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            
                @if(in_array(3, $roles))
                <li class="{{ ($currentRoute == 'add-task' || $currentRoute == 'task-list' ? 'active' : '') }}">
                    <a href="{{ route('task-list') }}"><i class="fa fa-tasks"></i>
                        <span class="nav-label">Task List</span></a>
                </li>
                @endif
                
                @if(in_array(5, $roles))
                <li class="{{ ($currentRoute == 'performance' ||  $currentRoute == 'performance-emp-detail' || $currentRoute == 'employee-performance-list' || $currentRoute == 'performance-emp-detail/*' ? 'active' : '') }}">
                    <a href="{{ route('performance') }}"><i class="fa fa-user"></i>
                        <span class="nav-label">Performance</span></a>
                </li>
                @endif
                
                @if(in_array(4, $roles))
                <li class="{{ ($currentRoute == 'ticket-list' || $currentRoute == 'add-ticket' ? 'active' : '') }}">
                    <a href="{{ route('ticket-list') }}"><i class="fa fa-ticket"></i>
                        <span class="nav-label">Tickets</span></a>
                </li>
                @endif
            @endif
        </ul>
         

    </div>
</nav>