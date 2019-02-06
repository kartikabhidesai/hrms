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
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="John" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-9">
                                    <input type="text" name="department" value="IT" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date Of Submit</label>
                                <div class="col-sm-9">
                                    <input type="text" name="date_of_submit" value="" class="form-control">
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
                                    <select class="form-control">
                                        <option>Select any option</option>
                                        <option value="clock_in_times">Clock in times</option>
                                        <option value="standard_or_basic_hours">Standard or basic hours</option>
                                        <option value="overtime_hours">Overtime hours</option>
                                        <option value="absence">Absence</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="total_hrs" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description Of Request</label>
                                <div class="col-sm-9">
                                    <textarea name="reuest_note" class="form-control" rows="4" cols="4"></textarea>
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
@endsection
