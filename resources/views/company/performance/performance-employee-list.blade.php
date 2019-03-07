@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Performance</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">90%</h1>
                    <h1 class="no-margins">Excellent</h1>
                    <div class="stat-percent font-bold text-info"></div>
                    <small></small>
                </div>
            </div>
        </div>
 


        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Performance: {{ $singleemployee['name'] }}</h5>
                    <div class="ibox-tools">
                      <a href="{{ route('performance-emp-detail',array('id'=>$empId)) }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <form name="add-user" id="performance" enctype="multipart/form-data" class="form-horizontal" action="{{ route('addperformance') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-lg-12s">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <table width="100%">
                                    <tr>
                                        <td><b>Name:</b> {{$singleemployee['name']}}</td>
                                        <td><b>Department:</b> {{$singleemployee['department_name']}}</td>
                                        <td><b>Started Date:</b> {{$singleemployee['date_of_joining']}}</td>
                                        <td><b>Employeement Level: </b>80</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 20px;"><b>Supervisor:</b> Abbas Ahmad</td>
                                        <td style="padding-top: 20px;"><b>Branch:</b> Riyad</td>
                                        <td style="padding-top: 20px;"><b>Date:</b> 09/09/2018</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12s rating">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                             <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="">
                            <thead>
                                <tr>
                                    <th >Task</th>
                                    <th>Note & Dettails</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Availibility</th>
                                    <th>Quality</th>
                                    <th>Honesty</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(count($employeePerfirmance) > 0)
                              @foreach($employeePerfirmance as $row => $value)
                          
                                <tr class="gradeU">
                                    <td> 
                                       <?= $value['id'] ?>
                                    </td>
                                    <td> 
                                       <?= $value['notes_and_details'] ?>
                                    </td>
                                    <td> 
                                       <?= $monthis[$value['month']] ?>
                                    </td>
                                    <td> 
                                       <?= $value['year'] ?>
                                    </td> 
                                    <td> 
                                       <ul id='availability'>
                                          @for($i = 1; $i <= 5;$i++)
                                              @if($i <= $value['availability'])
                                                 <i class='fa fa-star fa-fw' style="color: #FFCC36;"></i>
                                              @else
                                                 <i class='fa fa-star fa-fw'></i> 
                                              @endif   
                                          @endfor
                                        </ul>
                                    </td>
                                    <td> 
                                       <ul id='quality'>
                                          @for($i = 1; $i <= 5;$i++)
                                              @if($i <= $value['quality'])
                                                 <i class='fa fa-star fa-fw' style="color: #FFCC36;"></i>
                                              @else
                                                 <i class='fa fa-star fa-fw'></i> 
                                              @endif   
                                          @endfor
                                        </ul>
                                    </td>
                                    <td> 
                                       <ul id='honesty'>
                                          @for($i = 1; $i <= 5;$i++)
                                              @if($i <= $value['honesty'])
                                                 <i class='fa fa-star fa-fw' style="color: #FFCC36;"></i>
                                              @else
                                                 <i class='fa fa-star fa-fw'></i> 
                                              @endif   
                                          @endfor
                                        </ul>
                                    </td>
                                </tr>
                              @endforeach
                              @else
                              <tr class="gradeU">
                                    <td colspan="7" colspan="text-center" style="text-align: center !important;"> 
                                       <span class="text-danger" >No record Found</span>
                                    </td>
                                </tr>
                              @endif
                              </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
