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
                        IN+
                    </div>
                </li>
               
                <li class="{{ ($currentRoute == 'employee-dashboard'  ? 'active' : '') }}">
                    <a href="{{ route('employee-dashboard') }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                
                <li class="{{ ($currentRoute == 'employee-leave' || $currentRoute == 'add-leave'  || $currentRoute == 'edit-leave' ? 'active' : '') }}">
                    <a href="{{ route('employee-leave') }}"><i class="fa fa-calendar-check-o"></i> <span class="nav-label">Leave</span></a>
                </li>  
                
                
                <li class="{{ ($currentRoute == 'payroll-employee' ? 'active' : '') }}">
                    <a href="{{ route('payroll-employee') }}"><i class="fa fa-calendar-check-o"></i> <span class="nav-label">Payroll</span></a>
                </li>
              
                
               
                
                <li class="{{ ($currentRoute == 'emp-communication' ? 'active' : '') }} {{ ($currentRoute == 'emp-compose' ? 'active' : '') }} {{ ($currentRoute == 'emp-communication-detail' ? 'active' : '') }} {{ ($currentRoute == 'emp-communication-detail/*' ? 'active' : '') }}">
                    <a href="{{ route('emp-communication') }}"><i class="fa fa-history"></i>
                    <span class="nav-label">Communication</span></a>
                </li>
                
                
                <li class="{{ ($currentRoute == 'emp-task-list' ? 'active' : '') }}">
                    <a href="{{ route('emp-task-list') }}"><i class="fa fa-tasks"></i>
                    <span class="nav-label">Task List</span></a>
                </li>
                
                
              
                <li class="{{ ($currentRoute == 'ticket-list' || $currentRoute == 'add-ticket' ? 'active' : '') }}">
                    <a href="{{ route('ticket-list-emp') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Tickets</span></a>
                </li>
             
                
                
                <li class="{{ ($currentRoute == 'employee-training' || $currentRoute == 'add-training' ? 'active' : '') }}">
                    <a href="{{ route('employee-training') }}"><i class="fa fa-ticket"></i>
                    <span class="nav-label">Training</span></a>
                </li>
                
                <li class="{{ ($currentRoute == 'award' || $currentRoute == 'award-add' ? 'active' : '') }}">
                    <a href="{{ route('award') }}"><i class="fa fa-bullhorn"></i>
                    <span class="nav-label">Award</span></a>
                </li>
                
                 <li class="{{ ($currentRoute == 'employee-sent-notification' || $currentRoute == 'employee-notification-list' ? 'active' : '') }}">
                    <a href="{{ route('employee-sent-notification') }}"><i class="fa fa-bell"></i>
                    <span class="nav-label">Notification</span></a>
                 </li>
                 
                 <li class="{{ ($currentRoute == 'manage-time-change-request' ? 'active' : '') }} {{ ($currentRoute == 'new-time-change-request' ? 'active' : '') }}">
                    <a href="{{ route('manage-time-change-request') }}"><i class="fa fa-calendar-check-o"></i> <span class="nav-label">Manage Time Change Request</span></a>
                </li>  

                <li class="{{ ( $currentRoute == 'edit-advance-salary-request' || $currentRoute == 'new-advance-salary-request' || $currentRoute == 'advance-salary-request' ? 'active' : '') }} ">
                    <a href="{{ route('advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Advance Salary Request</span></a>
                </li>
            
                </li>
                <li class="{{ ($currentRoute == 'employee-chat' ? 'active' : '') }}">
                    <a href="{{ route('employee-chat') }}"><i class="fa fa-comments"></i>
                        <span class="nav-label">Chat</span></a>
                </li>
                
                
                <li class="{{ ($currentRoute == 'emp-performance' ||  $currentRoute == 'emp-performance-emp-detail' || $currentRoute == 'emp-employee-performance-list' || $currentRoute == 'emp-performance-emp-detail/*' ? 'active' : '') }}">
                    <a href="{{ route('emp-performance') }}"><i class="fa fa-user"></i>
                        <span class="nav-label">Performance</span>
                    </a>
                </li>
                
                
                
                 @if(in_array(4, $roles) || in_array(3, $roles) || in_array(13, $roles) || in_array(15, $roles) || in_array(19, $roles) || in_array(17, $roles) || in_array(18, $roles))
                <li class="{{ ($currentRoute == 'employee-ticket-list' ? 'active' : '') }} {{ ($currentRoute == 'employee-ticket-comments' ? 'active' : '') }} {{ ($currentRoute == 'employee-add-ticket' ? 'active' : '') }}  {{ ($currentRoute == 'employee-add-task' ? 'active' : '') }} {{ ($currentRoute == 'employee-task-list' ? 'active' : '') }} {{ ($currentRoute == 'employee-pay-slip' ? 'active' : '') }} {{ ($currentRoute == 'employee-approved-advance-salary-request' ? 'active' : '') }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Role</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        
                        @if(in_array(3, $roles))
                            <li class="{{ ($currentRoute == 'employee-add-task' || $currentRoute == 'employee-task-list' ? 'active' : '') }}">
                                <a href="{{ route('employee-task-list') }}"><i class="fa fa-tasks"></i>
                                    <span class="nav-label">Company Task List</span></a>
                            </li>
                        @endif
                        
                        @if(in_array(4, $roles))
                            <li class="{{ ($currentRoute == 'employee-ticket-list' || $currentRoute == 'employee-ticket-comments' || $currentRoute == 'employee-add-ticket' ? 'active' : '') }}">
                                <a href="{{ route('employee-ticket-list') }}"><i class="fa fa-tasks"></i>
                                    <span class="nav-label">Company Tickets List</span></a>
                            </li>
                        @endif
                        
                        @if(in_array(13, $roles))
                            <li class="{{ ($currentRoute == 'employee-pay-slip' ? 'active' : '') }}">
                                <a href="{{ route('employee-pay-slip') }}"><i class="fa fa-history"></i>
                                <span class="nav-label">Company Pay Slip</span></a>
                            </li>
                        @endif

                        @if(in_array(15, $roles))
                            <li class="{{ ( $currentRoute == 'employee-approved-advance-salary-request' ? 'active' : '') }}">
                                <a href="{{ route('employee-approved-advance-salary-request') }}"><i class="fa fa-money" ></i> <span class="nav-label">Company Approved Advance Salary</span></a>
                            </li>
                        @endif

                        @if(in_array(19, $roles))
                            <li class="{{ ($currentRoute == 'employee-daily-attendance' ? 'active' : '') }}">
                                <a href="{{ route('employee-daily-attendance') }}"><i class="fa fa-thumb-tack"></i>
                                <span class="nav-label">Company Daily Attendance</span></a>
                            </li>
                        @endif

                        @if(in_array(17, $roles))
                        <li class="{{ ($currentRoute == 'employee-attendance-report' ? 'active' : '') }}">
                            <a href="{{ route('employee-attendance-report') }}"><i class="fa fa-bar-chart"></i>
                            <span class="nav-label">Company Attendance Report</span></a>
                        </li>
                        @endif

                        @if(in_array(18, $roles))
                            <li class="{{ ($currentRoute == 'employee-manage-attendance-history' ? 'active' : '') }}">
                                <a href="{{ route('employee-manage-attendance-history') }}"><i class="fa fa-envelope"></i>
                                    <span class="nav-label">Company Manage Attendance History</span></a>
                            </li>
                        @endif
                        
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>