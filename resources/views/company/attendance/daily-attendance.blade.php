@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
	   <div class="row">
            <div class="col-lg-12">
			{{ csrf_field() }}
			    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Attendance Of All Employees</h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'manageDailyAttendance' )) }}

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

                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-9"> 
                                 <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date" value="{{ $date }}" id="attendanceDate" placeholder="Select Date" class="attendanceDate form-control attendanceDate dateField" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary getattdance" type="button">Manage Attendance</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
             @if(isset($getEmployees))
                <div class="col-lg-12">
                       <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Attendance For {{ $departmentname }}</h5>
                                <h5 class="pull-right">Date : {{ $date }}</h5>
                            </div>
                       </div>
                </div>
            @endif
        </div>
    </div>
@endsection
