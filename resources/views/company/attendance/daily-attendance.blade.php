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
                                        @if($detail)
                                            @foreach($detail as $department)
                                            <option value="{{ $department->id }}" {{ ($department->id == $departentId ? 'selected="selected"' : '') }} >{{ $department->department_name }}</option>
                                            @endforeach
                                        @endif
                                    @else
                                        <option value="all" >All Employees</option>
                                        @if($detail)
                                            @foreach($detail as $department)
                                                <option value="{{ $department->id }}" >{{ $department->department_name }}</option>
                                            @endforeach
                                        @endif
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

                        <form action="" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                            <div id="attendance_update">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th style="width: 40%;">Reason Of Absence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($getEmployees->count() > 0)
                                            @foreach($getEmployees as $key => $getEmployee)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $getEmployee->name }}</td>
                                                    <td>
                                                        <select class="form-control" name="status_1" onchange="get_reason_holder(this, {{ $getEmployee->id }});" id="status_{{ $getEmployee->id }}">
                                                            <option value="1" selected="">Present</option>
                                                            <option value="2">Absent</option>
                                                        </select>   
                                                    </td>
                                                    <td>
                                                        <span style="display: none;" id="reason_holder_{{ $getEmployee->id }}">
                                                            <input type="text" name="reason_{{ $getEmployee->id }}" class="form-control" value="">
                                                        </span>
                                                        <span style="display: block;" id="reason_holder_2_{{ $getEmployee->id }}"></span>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="attendance_id_{{ $getEmployee->id }}" value="{{ $getEmployee->id }}">
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"><p class="text-center">No Employees present!</p></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" name="number_of_attendances" value="{{ $getEmployees->count() }}">
                        
                            <center>
                                <button type="submit" class="btn btn-success" id="submit_button">
                                    <i class="entypo-check"></i> Save Changes</button>
                            </center>
                        </form>
                </div>
            @endif
        </div>
    </div>
@endsection
