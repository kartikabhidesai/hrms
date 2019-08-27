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

<div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> 
            </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                <input type="hidden" name="_tokenNotification" value="{{ csrf_token() }}">

                    <a class="dropdown-toggle count-info " data-id="{{ $session['logindata'][0]['id'] }}" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i> 
                         <span class="label label-primary" id="countNotification">
                         {{ $session['notificationdata'][0]['notification_count'] }}
                        </span>
                    </a>
                   
                    <ul class="dropdown-menu dropdown-alerts">
                        @if($session['notificationdata'][0]['notification_count']!='0')
                           <?php $countNotific=3; ?>
                            @if($session['notificationdata'][0]['notification_count'] < 3)
                            <?php $countNotific=$session['notificationdata'][0]['notification_count']; ?>
                            @endif
                                @for($i=0; $i < $countNotific; $i++)
                                <li>
                                    @if(!empty($session['notificationdata'][0]['notification_list'][$i]['route'])) 
                                    @php
                                    $mystring = $session['notificationdata'][0]['notification_list'][$i]['route'];
                                    $findme   = '/';
                                    $pos = strpos($mystring, $findme);
                                        if($pos){
                                        
                                    @endphp
                                    <a class="notification-count" href="{{ url($session['notificationdata'][0]['notification_list'][$i]['route']) }}" data-id="{{ $session['logindata'][0]['id'] }}" notification-id="{{ $session['notificationdata'][0]['notification_list'][$i]['id'] }}">
                                    @php
                                        }
                                        else{
                                    @endphp
                                    <a class="notification-count" href="{{ route($session['notificationdata'][0]['notification_list'][$i]['route']) }}" data-id="{{ $session['logindata'][0]['id'] }}" notification-id="{{ $session['notificationdata'][0]['notification_list'][$i]['id'] }}">
                                    @php
                                        
                                        }
                                    @endphp
                                    
                                    @else 
                                        @if(!empty(Auth()->guard('employee')->user())) 
                                        <a class="notification-count" href="{{ route('employee-notification-list') }}" data-id="{{ $session['logindata'][0]['id'] }}" notification-id="{{ $session['notificationdata'][0]['notification_list'][$i]['id'] }}">
                                        @else
                                            <a class="notification-count" href="{{ route('notification-list') }}" data-id="{{ $session['logindata'][0]['id'] }}" notification-id="{{ $session['notificationdata'][0]['notification_list'][$i]['id'] }}">
                                        @endif
                                    @endif         
                                            <div>
                                                <i class="fa fa-envelope fa-fw"></i> {{ $session['notificationdata'][0]['notification_list'][$i]['message'] }}
                                                <!-- <span class="pull-right text-muted small">4 minutes ago</span> -->
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                @endfor
                            @endif
                        <li>
                            <div class="text-center link-block">
                            @if(!empty(Auth()->guard('employee')->user())) 
                             <a href="{{ route('employee-notification-list') }}">
                            @else
                                @if(!empty(Auth()->guard('admin')->user()))
                                <!--admin-notification-->
                                   <a href="{{ route('admin-notification') }}">
                                @else
                                    <a href="{{ route('notification-list') }}">
                                @endif
                                
                            @endif 
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                       
                    </ul>
                    
                </li>
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <!-- <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>

        </nav>
        </div>