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
                        HRMS
                    </div>
                </li>
                
                <li class="{{ ($currentRoute == 'admin-dashboard'  ? 'active' : '') }}">
                    <a href="{{ route('admin-dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
                   <!--  <ul class="nav nav-second-level collapse">
                        <li><a href="index.html">Dashboard v.1</a></li>
                        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                    </ul> -->
                </li>
                <li class="{{ ($currentRoute == 'list-demo'  ? 'active' : '') }}">
                    <a href="{{ route('list-demo') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Demo</span></a>
                </li>
                <li class="{{ ($currentRoute == 'list-company'  ? 'active' : '') }} {{ ($currentRoute == 'add-company'  ? 'active' : '') }} {{ ($currentRoute == 'edit-company'  ? 'active' : '') }}">
                    <a href="{{ route('list-company') }}"><i class="fa fa-industry"></i> <span class="nav-label">Company</span></a>
                </li> <li class="{{ ($currentRoute == 'list-cmspage'  ? 'active' : '') }} {{ ($currentRoute == 'edit-cmspage'  ? 'active' : '') }} {{ ($currentRoute == 'edit-company'  ? 'active' : '') }}">
                    <a href="{{ route('list-cmspage') }}"><i class="fa fa-industry"></i> <span class="nav-label">CMS Page</span></a>
                </li>
                
                </li> <li class="{{ ($currentRoute == 'edit-email' || $currentRoute == 'add-email' || $currentRoute == 'list-email'  ? 'active' : '') }} ">
                    <a href="{{ route('list-email') }}"><i class="fa fa-envelope-o"></i> <span class="nav-label">Email</span></a>
                </li>
                
                </li> 
                    <li class="{{ ($currentRoute == 'setting'   ? 'active' : '') }} ">
                    <a href="{{ route('setting') }}"><i class="fa fa-cog" ></i> <span class="nav-label">Setting</span></a>
                </li>
                 <li class="{{ ($currentRoute == 'set-tax' ? 'active' : '') }}">
                    <a href="{{ route('set-tax') }}"><i class="fa fa-percent"></i>
                    <span class="nav-label">Set Tax</span></a>
                </li>
              <!--   <li class="active">
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="table_basic.html">Static Tables</a></li>
                        <li class="active"><a href="table_data_tables.html">Data Tables</a></li>
                        <li><a href="table_foo_table.html">Foo Tables</a></li>
                        <li><a href="jq_grid.html">jqGrid</a></li>
                    </ul>
                </li> -->
             
            </ul>

        </div>
    </nav>