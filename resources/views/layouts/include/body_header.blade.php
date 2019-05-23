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
           <!--  <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
               <!--  <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                </li> -->
               <!--  <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
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
                                  
                                        <a class="notification-count" href="{{ route($session['notificationdata'][0]['notification_list'][$i]['route']) }}" data-id="{{ $session['logindata'][0]['id'] }}" notification-id="{{ $session['notificationdata'][0]['notification_list'][$i]['id'] }}">
                                           
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
                                <a href="{{ route('notification-list') }}">
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