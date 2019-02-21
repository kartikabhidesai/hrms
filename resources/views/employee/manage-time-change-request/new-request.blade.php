@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Manage Time Change Request Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'newTimeChangeRequest' )) }}

                        <div class="col-lg-6">
                            
                            <div class="form-group" hidden>
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="empid" value="{{ $emp_id }}" class="form-control">
                                    <input type="text" name="company_id" value="{{ $company_id }}" class="form-control">
                                    <input type="text" name="depart_id" value="{{ $dep_id }}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ $name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-9">
                                    <input type="text" name="department" value="{{ $depat_name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date Of Submit</label>
                                <div class="col-sm-9">
                                    <div class="input-group from_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_submit" id="date" value="" class="form-control from_date dateField" placeholder="Date Of Submit" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            
                            

                            <div class="form-group">
                                <label class="col-sm-2 control-label">From:</label>
                                <div class="col-sm-9"> 
                                    <div class="input-group from_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="from_date" value="" id="from_date" placeholder="From Date" class="form-control from_date dateField" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">To:</label>
                                <div class="col-sm-9"> 
                                    <div class="input-group to_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="to_date" value="" id="to_date" placeholder="To Date" class="form-control to_date dateField" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type of Request</label>
                                <div class="col-sm-9">
                                    {{ Form::select('typeRequest', $type_of_request , null, array('class' => 'form-control m-b c-select typeRequest', 'id' => 'typeRequest')) }}
                                    <!-- <select class="c-select form-control" name="typeRequest">
                                        @foreach ($type_of_request as $indexkey=>$val)
                                          <option value="{{$indexkey}}">{{ $val }}</option>
                                        @endforeach
                                    </select> -->
                                </div>
                            </div>

                            <div class="form-group requestNameTextBox " style="display: none;">
                                <label class="col-sm-2 control-label">Request Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="request_name" id="request_name" placeholder="Enter Request Name" class="form-control request_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="total_hrs" placeholder="Total Hours" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description Of Request</label>
                                <div class="col-sm-9">
                                    <textarea name="reuest_note" class="form-control" placeholder="Description Of Request" rows="4" cols="4"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    input.has-error {
        border-color: red;
    }
    .has-error .select2,.has-error .select2-selection{
        color: red !important;
        border-color: red !important;
    }

</style>
@endsection
