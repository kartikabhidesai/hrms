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
                                <select class="form-control" name="department_id">
                                    <option value="" selected="">Select Employees Of A Department</option>
                                    <option value="all">All Employees</option>
                                    @foreach($detail as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-9"> 
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date" value="" id="attendanceDate" placeholder="Select Date" class="form-control attendanceDate dateField" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">Manage Attendance</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
