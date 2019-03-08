@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'paySlip' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pay Slip</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Task</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="task">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Department</label>
                                    <div class="col-lg-10">
                                        {{ Form::select('department', $department , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Responsibility</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="about_task"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Requirement</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="about_task"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Experience Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="experience" name="experience">
                                            @foreach($experince as $key=>$val)
                                            <option value="{{$key}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Requirement</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="task">
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="col-sm-3 control-label">Job Time</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            {{ Form::radio('parttime', 'parttime', false , ['class' => 'parttime','id' => 'parttime']) }} Part time
                                        </label>
                                        <label class="radio-inline">
                                            {{ Form::radio('fulltime', 'fulltime', true , ['class' => ' fulltime','id' => 'fulltime']) }} Full time
                                        </label>  
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="col-sm-3 control-label">Contract</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            {{ Form::radio('permanant', 'permanant', true , ['class' => 'permanant','id' => 'permanant']) }} Permanant
                                        </label>
                                        <label class="radio-inline">
                                            {{ Form::radio('temparary', 'temparory',  false , ['class' => ' temparory','id' => 'temparary']) }} Temparory
                                        </label>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Salary</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="salary">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Conact us</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="conatact_us">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="data_1">
                                    <label class="col-sm-2 control-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-group start_date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" id="date" value="" class="form-control start_date dateField" placeholder="Start date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="data_2">
                                    <label class="col-sm-2 control-label">Expire Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-group expire_date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="expire_date" id="date" value="" class="form-control expire_date dateField" placeholder="Start date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Job id</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="job_id">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-5 col-lg-6">
                                    <button class="btn btn-sm btn-primary" type="submit">Generate Job Offer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

@endsection
