@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
	   <div class="row">
            <div class="col-lg-12">
			{{ csrf_field() }}
			    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Send New SMS</h5>
                    </div>
                    <div class="ibox-content">
                       {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'sendSMS' )) }}  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-9">
                                    <select class="form-control dept_id"  id="dept_id" name="dept_id">
                                        <option value="" selected="">Select Department</option>
                                        <option value="All" >All Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                        @endforeach
                                         
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="emparray" id="emparray" class="emparray">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employees</label>
                                <div class="col-sm-9">
                                    <select class="form-control emp_id" id="emp_id" name="emp_id">
                                        <option value="">Select Employee</option>
                                       <!--  <option value="All">Select All</option>
                                        @foreach($getAllEmpOfCompany as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-9"> 
                                    <textarea class="form-control message" cols="5" rows="4" name="message" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary sendSMS" type="submit">Send</button>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
