@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Company Form</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addPlan' )) }}

                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="form-group"><label class="col-lg-2 control-label">Code</label>
                                <div class="col-lg-9">
                                    {{ Form::text('code', null, array('class' => 'form-control code' ,'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group"><label class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-9">
                                    {{ Form::text('title', null, array('class' => 'form-control title' ,'required')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="form-group"><label class="col-lg-2 control-label">Charge</label>
                                <div class="col-lg-9">
                                    {{ Form::text('charge', null, array('class' => 'form-control charge' ,'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group"><label class="col-lg-2 control-label">Duration</label>
                                <div class="col-lg-9">
                                    {{ Form::select('duration', $duration, null, array('class' => 'form-control m-b', 'id' => 'duration','required')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">Expiration</label>
                                <div class="col-sm-9"> 
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="expiry_at" value="{{ isset($leaveEdit) && !empty($leaveEdit['expiry_at']) ? date('d-m-Y',strtotime( $leaveEdit['start_date'])) : '' }}" id="expiry_at" placeholder="expiry date" class="form-control expiry_at dateField" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-8">
                            <h3><b>Plane Feature</b></h3>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_profile">
                                Manage Profile</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_calender">
                                Manage Calender</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="attendance_manage">
                                Attendance Management</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_profile">
                                Manage Profile</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_payroll">
                                Manage Payroll</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_payroll">
                                Manage payroll</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="managebankandcash">
                                Manage Bank And Cash</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_advance_salary">
                                Manage Advance Salary</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_recrutement">
                                Manage Recrutement</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_performance">
                                Manage Performance</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="announcement_manage">
                                Announcement Management</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_task">
                                Manage Task</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_award">
                                Manage Award</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_client">
                                Manage Client</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="communication">
                                Communication</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_report">
                                Report Management</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_user">
                                User Manafement</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_department">
                                Department Manage</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="setting_manage">
                                Manage setting</label>
                        </div>
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="manage_chat">
                                Manage chat</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <label class="checkbox-inline"> 
                                <input type="checkbox"  id="plan_feature" name="plan_feature[]" value="user_profile">
                                user Profile</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-4">
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>	
    </div>
</div>

@endsection