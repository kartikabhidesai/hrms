@extends('layouts.app')
@section('content')

   <div class="wrapper wrapper-content">
        <div class="row">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                       <div class="col-lg-12">
                           <div class="wrapper wrapper-content">
                                   <div class="row">
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title red-bg">
                                                <h5><i class="fa fa-exchange"></i>&nbsp;&nbsp;Income & Expenses </h5>
                                                <div class="ibox-tools">
                                                    <a class="collapse-link">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ibox-content red-bg">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>$ 20 054.43</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Todays Income
                                                        <br/>
                                                        <small class="m-r"><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="ibox-content red-bg">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>$ 20 054.43</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Todays Expenses
                                                        <br/>
                                                        <small class="m-r"><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                            <div class="ibox-content red-bg">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>$ 20 054.43</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Todays Income
                                                        <br/>
                                                        <small class="m-r"><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="ibox-content red-bg">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>$ 20 054.43</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Todays Expenses
                                                        <br/>
                                                        <small class="m-r"><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                       
                                    <div class="col-lg-4 ">
                                        <div class="ibox float-e-margins " >
                                            <div class="ibox-title bg-warning">
                                                <h5><i class="fa fa-wpforms"></i>&nbsp;&nbsp;Employee State </h5>
                                                <div class="ibox-tools">
                                                    <a class="collapse-link">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ibox-content bg-warning">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>{{ $presentEmployee }}</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Present Employee
                                                        <br/>
                                                        <small class="m-r"><a href="{{ "attendance-report" }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="ibox-content bg-warning">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>{{ $absentEmployee }}</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Absent Employee
                                                        <br/>
                                                        <small class="m-r"><a href="attendance-report"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="ibox-content bg-warning">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3>{{ $totalEmployee }}</h3></small>
                                                    </div>
                                                    <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Total Employee
                                                        <br/>
                                                        <small class="m-r"><a href="attendance-report"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="ibox-content bg-warning">
                                                <div>
                                                    <div class="pull-right text-right">
                                                        <small class="font-bold"><h3></h3></small>
                                                    </div>
                                                    <h3>
                                                        <br/>
                                                        <small class="m-r"><a href="#"></a> </small>
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                       <div class="ibox float-e-margins">
                                           <div class="ibox-title bg-info">
                                               <h5><i class="fa fa-tasks"></i>&nbsp;&nbsp;Task </h5>
                                               <div class="ibox-tools">
                                                   <a class="collapse-link">
                                                       <i class="fa fa-chevron-up"></i>
                                                   </a>
                                               </div>
                                           </div>
                                           <div class="ibox-content bg-info">
                                               <div>
                                                   <div class="pull-right text-right">
                                                       <small class="font-bold"><h3>{{ $penddingTask }}</h3></small>
                                                   </div>
                                                   <h3><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Pending Task
                                                       <br/>
                                                       <small class="m-r"><a href="{{ route('task-list')}}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                   </h3>
                                               </div>
                                           </div>

                                           <div class="ibox-content bg-info">
                                               <div>
                                                   <div class="pull-right text-right">
                                                       <small class="font-bold"><h3> {{ $progressTask }}</h3></small>
                                                   </div>
                                                   <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;In Progress Task
                                                       <br/>
                                                       <small class="m-r"><a href="{{ route('task-list')}}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                   </h3>
                                               </div>
                                           </div>
                                           
                                           <div class="ibox-content bg-info">
                                               <div>
                                                   <div class="pull-right text-right">
                                                       <small class="font-bold"><h3>{{ $completedTask }}</h3></small>
                                                   </div>
                                                   <h3><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Completed Task
                                                       <br/>
                                                       <small class="m-r"><a href="{{ route('task-list')}}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                   </h3>
                                               </div>
                                           </div>

                                           <div class="ibox-content bg-info">
                                               <div>
                                                   <div class="pull-right text-right">
                                                       <small class="font-bold"><h3>{{ $totalTask }}</h3></small>
                                                   </div>
                                                   <h3><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Total Task
                                                       <br/>
                                                       <small class="m-r"><a href="{{ route('task-list')}}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp; More Info </a> </small>
                                                   </h3>
                                               </div>
                                           </div>

                                       </div>
                                   </div>
                                   </div>
                           </div>
                       </div>
                    </div>
                
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1"> Events </a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Overdue Task</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-check-circle fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                @if($upcomingevnt['title'])
                                                    <div class="col-lg-8">
                                                            <h3><strong>Title : {{ $upcomingevnt['title'] }}</strong></h3>
                                                            <h3><strong>Date : {{ date("d-m-Y",strtotime($upcomingevnt['event_date'])) }}</strong></h3>
                                                    </div>
                                                @else
                                                    <div class="col-lg-8">
                                                            <h3><strong>0</strong></h3>
                                                            <h3><strong>Upcoming Event</strong></h3>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane ">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-rocket fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h3><strong>{{ $overdueTask }}</strong></h3>
                                                    <h3><strong>Overdue Task</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-11">Salary Payments</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-22">Other Payments</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-11" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-money fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h3><strong>{{ $salaryPayment }}</strong></h3>
                                                    <h3><strong>Salary Payments</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-22" class="tab-pane ">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-empire fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h3><strong>{{ $otherPayment }}</strong></h3>
                                                    <h3><strong>Other Payments</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-111">Recent Application</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-222">Pending Leaves</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-111" class="tab-pane active">
                                        <div class="panel-body">
                                           <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-gg fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h3><strong>{{$recruitment}}</strong></h3>
                                                    <h3><strong>Recent Application</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-222" class="tab-pane ">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                     <strong><i class="fa fa-yelp fa-4x" aria-hidden="true"></i></strong>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h3><strong>{{$leaves}}</strong></h3>
                                                    <h3><strong>Pending Leaves</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Progress Bars</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    
                                    @foreach($statusBar as $key => $value)
                                       <h5>{{ $value['about_task']}} <span class="pull-right">{{ $value['complete_progress']}} %</span></h5>
                                      
                                        <div class="progress progress-striped">
                                            <div style="width: {{ $value['complete_progress']}}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-lg-6">
                            @if(count($annousmentList) > 0)
                                <div class="ibox-content" >
                                    <div class="row">
                                       <div class="col-lg-10 col-lg-offset-1">
                                           <div class="ibox">
                                               <h3>Announcement List</h3>
                                                <div class="slick_demo_3">
                                                    
                                                    @foreach($annousmentList as $key => $value)

                                                        <div>
                                                            <div class="ibox-content">
                                                                <h2>{{ $value['title'] }}</h2>
                                                                <p>
                                                                    {{ $value['content'] }}

                                                                </p>
                                                                <span class="pull-left">
                                                                    <b>Start Date : {{ date("d-m-Y", strtotime($value['date'])) }}</b>
                                                                </span>
                                                                <span class="pull-right">
                                                                    <b>Expiry Date : {{ date("d-m-Y", strtotime($value['expiry_date'])) }}</b>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            @endif
                        </div>
                            
                    </div>
                    
                </div>
        </div>
    </div>

@endsection
