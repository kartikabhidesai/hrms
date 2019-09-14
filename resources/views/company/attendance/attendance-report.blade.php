@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            {{ csrf_field() }}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Attendance Report</h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'showReport' )) }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Employees By Department </label>
                            <div class="col-sm-9">
                                <select class="form-control department_id" name="department_id">
                                    <option value="" selected="">Select Employees Of A Department</option>
                                    @if(isset($getAttedanceReport))
                                        <!-- <option value="all" {{ ($departentId == "all" ? 'selected="selected"' : '') }}>All Employees</option> -->
                                        @foreach($detail as $department)
                                            <option value="{{ $department->id }}" {{ ($department->id == $departentId ? 'selected="selected"' : '') }} >{{ $department->department_name }}</option>
                                        @endforeach
                                    @else
                                        <!-- <option value="all" >All Employees</option> -->
                                        @foreach($detail as $department)
                                            <option value="{{ $department->id }}" >{{ $department->department_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Year</label>
                            <div class="col-sm-9"> 
                                <select class="form-control year" name="year">
                                    <option value="" selected="">Select Year</option>
                                    @if(isset($getAttedanceReport))
                                        @for ($year=2015; $year <= 2099; $year++)
                                            <option value="{{ $year }}" {{ ($get_year == $year ? 'selected="selected"' : '') }}>{{ $year }}</option>
                                        @endfor
                                        @else
                                            @for ($year=2015; $year <= 2099; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Month</label>
                            <div class="col-sm-9"> 
                                <select class="form-control month" name="month">
                                    <option value="" selected="">Select Month</option>
                                    @if(isset($getAttedanceReport))
                                        <option value="1" {{ ($get_month == 'January' ? 'selected="selected"' : '') }}>January</option>
                                        <option value="2" {{ ($get_month == 'February' ? 'selected="selected"' : '') }}>February</option>
                                        <option value="3" {{ ($get_month == 'March' ? 'selected="selected"' : '') }}>March</option>
                                        <option value="4" {{ ($get_month == 'April' ? 'selected="selected"' : '') }}>April</option>
                                        <option value="5" {{ ($get_month == 'May' ? 'selected="selected"' : '') }}>May</option>
                                        <option value="6" {{ ($get_month == 'June' ? 'selected="selected"' : '') }}>June</option>
                                        <option value="7" {{ ($get_month == 'July' ? 'selected="selected"' : '') }}>July</option>
                                        <option value="8" {{ ($get_month == 'August' ? 'selected="selected"' : '') }}>August</option>
                                        <option value="9" {{ ($get_month == 'September' ? 'selected="selected"' : '') }}>September</option>
                                        <option value="10" {{ ($get_month == 'October' ? 'selected="selected"' : '') }}>October</option>
                                        <option value="11" {{ ($get_month == 'November' ? 'selected="selected"' : '') }}>November</option>
                                        <option value="12" {{ ($get_month == 'December' ? 'selected="selected"' : '') }}>December</option>
                                    @else
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary getAttedanceReport" type="submit">Show Report</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        @if(isset($getAttedanceReport))
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="text-align: center;">
                        <div class="tile-stats tile-gray">
                            <div class="icon"><i class="entypo-docs"></i></div>
                            <h2 style="color: #696969;">Attendance Sheet</h2>
                            <h3 style="color: #696969;"> Department : {{ $departmentname }}<br>{{ $get_month }} {{ $get_year }} </h3>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <table class="table table-bordered" id="my_table">
                        <thead>
                            <tr>
                                <td style="text-align: center;">
                                    Employees <i class="fa fa-arrow-down fa-lg"></i> |
                                    Date <i class="fa fa-arrow-right fa-lg"></i>
                                </td>
                                <td style="text-align: center;">
                                    Summary<br>( Total Presence / Total Absence ) </td>
                                    @for($day=1; $day<=cal_days_in_month(CAL_GREGORIAN, $month, $get_year); $day++)
                                        <td style="text-align: center;">{{ $day }}</td>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employeAttandanceData as $key => $value)
                            <tr>
                                    <td style="text-align: center;"> {{ $key }} </td>
                                    <td style="text-align: center;"> {{ count($value) - 1  }} / {{ cal_days_in_month(CAL_GREGORIAN, $month, $get_year) }} </td>
                                    @for($day=1; $day<=cal_days_in_month(CAL_GREGORIAN, $month, $get_year); $day++)
                                        @if(in_array($day,$value['date']))
                                            @for($j=0;$j < count($value);$j++)
                                                @if(isset($value[$j]))
                                                    @if($day == date('j', strtotime($value[$j]['date'])) && $value[$j]['attendance'] == 'present')
                                                        <td style="text-align: center;"><i class="fa fa-circle" style="color: #00a651;"></i></td>
                                                    @endif
                                                    @if($day == date('j', strtotime($value[$j]['date'])) && $value[$j]['attendance'] == 'absent')
                                                        <td style="text-align: center;"><i class="fa fa-circle" style="color: #ee4749;"></i></td>
                                                    @endif
                                                @endif
                                            @endfor
                                        @else
                                             <td style="text-align: center;"></td>
                                        @endif
                                    @endfor
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    
                    <center>
                        <a href="javascript:;" class="btn btn-primary printattandance" onclick = "window.print()"> Print Attendance Sheet </a>
                    </center>
                </div>
            </div>
        @endif
    </div>
@endsection
