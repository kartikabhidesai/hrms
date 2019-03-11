@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>System Setting</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal systemSettingForm','files' => true, 'id' => 'systemSettingForm' )) }}

                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">System Name</label>
                        <div class="col-lg-9">
                            {{ Form::text('system_name', null, array('placeholder'=>'System Name', 'class' => 'form-control' )) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">System Title</label>
                        <div class="col-lg-9">
                            {{ Form::text('system_title', null, array('placeholder'=>'System Title', 'class' => 'form-control' )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-9">
                            {{ Form::textarea('address', null, array('placeholder'=>'Address', 'class' => 'form-control' )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-9">
                            {{ Form::text('phone', null, array('placeholder'=>'Phone', 'class' => 'form-control' )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            {{ Form::text('email', null, array('placeholder'=>'Email', 'class' => 'form-control' )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Language</label>
                        <div class="col-lg-9">
                            {{ Form::text('language', null, array('placeholder'=>'Language', 'class' => 'form-control' )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Photo</label>
                        <div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="image"/>
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary" type="submit">Save Setting</button>
                        </div>
                    </div>
                </div>
               {{ Form::close() }}
            </div>
        </div>  

    </div>
</div>

@endsection