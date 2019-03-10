@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'editRecruitment' )) }}
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
                                    <input type="hidden" name="editId" value="{{  $details->id }}">
                                        <input type="text" class="form-control" name="task" value="{{  $details->task }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Department</label>
                                    <div class="col-lg-10">
                                        {{ Form::select('department', $department , $details->department_id, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Responsibility</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="responsibility" >{{  $details->responsibility }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Experience Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="experience_level" name="experience_level">
                                            @foreach($experince as $key=>$val)
                                            <option value="{{$key}}" {{ ($details->experience_level==$key) ? "selected" : "" }} >{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Requirement</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="requirement"  value="{{  $details->requirement }}">
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="col-sm-3 control-label">Job Time</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                        <input type="radio" name="jobtime" id="jobtime" {{ ($details->jobtime=='parttime') ? "checked" : "" }} value="parttime" >  Part time
                                            
                                             <!-- {{ Form::radio('jobtime', 'parttime', false , ['class' => 'parttime','id' => 'parttime']) }} Part time -->
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="jobtime" id="jobtime" {{ ($details->jobtime=='fulltime') ? "checked" : "" }} value="fulltime" > Full time
                                            
                                            <!-- {{ Form::radio('jobtime', 'fulltime', true , ['class' => ' fulltime','id' => 'fulltime']) }} Full time -->
                                        </label>  
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="col-sm-3 control-label">Contract</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="contract" id="contract" {{ ($details->contract=='permanant') ? "checked" : "" }} value="permanant" > Permanant
                                            <!-- {{ Form::radio('contract', 'permanant', true , ['class' => 'permanant','id' => 'permanant']) }} Permanant -->
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="contract" id="contract" {{ ($details->contract=='temparory') ? "checked" : "" }} value="temparory" > Temparory
                                            <!-- {{ Form::radio('contract', 'temparory',  false , ['class' => ' temparory','id' => 'temparary']) }} Temparory -->
                                        </label>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Salary</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="salary"  value="{{  $details->salary }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="email"  value="{{  $details->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Conact us</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="conatact_us"  value="{{  $details->conatact_us }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="data_1">
                                    <label class="col-sm-2 control-label">Start Date</label>
                                    <div class="col-sm-9">
                                    <div class="input-group ">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" id="start_date"  class="form-control start_date" placeholder="Start date"  value="{{  date('d-m-Y', strtotime($details->start_date)) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="data_2">
                                    <label class="col-sm-2 control-label">Expire Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="expire_date" id="expire_date"  class="form-control expire_date" placeholder="Expire date"  value="{{  date('d-m-Y', strtotime($details->expire_date)) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Job id</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="job_id"  value="{{  $details->job_id }}">
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
