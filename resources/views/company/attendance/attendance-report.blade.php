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
                                    @if(isset($getEmployees))
                                        <option value="all" {{ ($departentId == "all" ? 'selected="selected"' : '') }}>All Employees</option>
                                        @foreach($detail as $department)
                                        <option value="{{ $department->id }}" {{ ($department->id == $departentId ? 'selected="selected"' : '') }} >{{ $department->department_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="all" >All Employees</option>
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
                                    @for ($year=2015; $year <= 2099; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Month</label>
                            <div class="col-sm-9"> 
                                <select class="form-control month" name="month">
                                    <option value="" selected="">Select Month</option>
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
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary getAttdanceReport" type="submit">Show Report</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="text-align: center;">
                        <div class="tile-stats tile-gray">
                            <div class="icon"><i class="entypo-docs"></i></div>
                            <h2 style="color: #696969;">Attendance Sheet</h2>
                            <h3 style="color: #696969;"> Department : Abhay<br>January 2019 </h3>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <table class="table table-bordered" id="my_table">
                        <thead>
                            <tr>
                                <td style="text-align: center;">
                                    Employees<i class="entypo-down-thin"></i> |
                                    Date <i class="entypo-right-thin"></i>
                                </td>
                                <td style="text-align: center;">
                                    Summary<br>( Total Presence / Total Absence ) </td>
                                    @for($day=1; $day<=cal_days_in_month(CAL_GREGORIAN,1,2019); $day++)
                                        <td style="text-align: center;">{{ $day }}</td>
                                    @endfor
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td style="text-align: center;"> Abhay Singh </td>
                                <td style="text-align: center;"> 0 / 0 </td>
                                @for($day=1; $day<=cal_days_in_month(CAL_GREGORIAN,1,2019); $day++)
                                    <td style="text-align: center;"></td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                    
                    <center>
                        <a href="#" class="btn btn-primary" target="_blank"> Print Attendance Sheet </a>
                    </center>
                </div>
            </div>
        
    </div>
@endsection
