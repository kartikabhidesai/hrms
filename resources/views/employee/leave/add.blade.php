@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Leave</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addLeave' )) }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-9">
                         {{ Form::date('start_date', null, array('class' => 'form-control start_date','required')) }}

                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-9">
                         {{ Form::date('end_date', null, array('class' => 'form-control end_date','required')) }}

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason</label>
                        <div class="col-sm-9"> 
                            {{ Form::textarea('reason', null, array('class' => 'form-control reason' ,'required')) }}
                        </div>
                    </div>
                    	
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
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