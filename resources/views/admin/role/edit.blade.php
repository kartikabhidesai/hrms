@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Role</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'editEmail' )) }}
                    <div class="form-group">
                        <div class="col-lg-9">
                            <input type="hidden" name="mailId" value="{{$id}}" >
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Template Name</label>
                        <div class="col-lg-9">
                            {{ Form::text('template_name', 'Parth', array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Template Type</label>
                        <div class="col-lg-9">
                            {{ Form::text('template_type','Testing', array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Email Contain</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="5" name="contain" id="contain">Testing</textarea>
                            
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
