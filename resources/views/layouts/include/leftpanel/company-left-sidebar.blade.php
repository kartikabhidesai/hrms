@php
$currentRoute = Route::current()->getName();
$session = Session::all();

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
                        IN+
                    </div>
                </li>
               
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
                <li class="{{ ($currentRoute == 'payroll-list' || $currentRoute == 'payroll-emp-detail' || $currentRoute == 'payroll-add' || $currentRoute == 'payroll-edit'  ? 'active' : '') }}">
                    <a href="{{ route('payroll-list') }}"><i class="fa fa-money"></i>
                    <span class="nav-label">Payroll</span></a>
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

                <li class="{{ ($currentRoute == 'pay-slip' ? 'active' : '') }}">
                    <a href="{{ route('pay-slip') }}"><i class="fa fa-history"></i>
                    <span class="nav-label">Pay Slip</span></a>
                </li>
                    
                <li class="{{ ( $currentRoute == 'campany-advance-salary-request' || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }} {{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Advance Salary</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ ( $currentRoute == 'campany-advance-salary-request'  || $currentRoute == 'add-advance-salary-request' ? 'active' : '') }}">
                            <a href="{{ route('campany-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Advance Salary Request</span></a>
                        </li>
                        <li class="{{ ( $currentRoute == 'approved-advance-salary-request' ? 'active' : '') }}">
                            <a href="{{ route('approved-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Approved Advance Salary</span></a>
                        </li>
                    </ul>
                 </li>
                 <li class="{{ ($currentRoute == 'communication' ? 'active' : '') }} {{ ($currentRoute == 'compose' ? 'active' : '') }}">
                    <a href="{{ route('communication') }}"><i class="fa fa-history"></i>
                    <span class="nav-label">Communication</span></a>
                </li> 
                <li class="{{ ($currentRoute == 'set-tax' ? 'active' : '') }}">
                    <a href="{{ route('set-tax') }}"><i class="fa fa-percent"></i>
                    <span class="nav-label">Set Tax</span></a>
                </li>
            </ul>
        </div>
    </nav>