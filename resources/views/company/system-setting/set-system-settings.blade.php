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
<<<<<<< HEAD
                        <label class="col-lg-2 control-label">System Name</label>
                        <div class="col-lg-9">
                            {{ Form::text('system_name', null, array('placeholder'=>'System Name', 'class' => 'form-control' )) }}
=======
                        <label class="col-lg-2 control-label">System name</label>
                        <div class="col-lg-10">
<<<<<<< HEAD
                            {{ Form::text('system_name', $current_cmpny_ss->system_name, array('placeholder'=>'System Name', 'class' => 'form-control' ,'required')) }}
=======
                            {{ Form::text('system_name', $sysSetting['system_name'], array('placeholder'=>'System Name', 'class' => 'form-control' ,'required')) }}
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">System Title</label>
<<<<<<< HEAD
                        <div class="col-lg-9">
                            {{ Form::text('system_title', null, array('placeholder'=>'System Title', 'class' => 'form-control' )) }}
=======
                        <div class="col-lg-10">
<<<<<<< HEAD
                            {{ Form::text('system_title', $current_cmpny_ss->system_title, array('placeholder'=>'System Title', 'class' => 'form-control' ,'required')) }}
=======
                            {{ Form::text('system_title', $sysSetting['system_title'], array('placeholder'=>'System Title', 'class' => 'form-control' ,'required')) }}
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Address</label>
<<<<<<< HEAD
                        <div class="col-lg-9">
                            {{ Form::textarea('address', null, array('placeholder'=>'Address', 'class' => 'form-control' )) }}
=======
                        <div class="col-lg-10">
<<<<<<< HEAD
                            {{ Form::textarea('address', $current_cmpny_ss->address, array('placeholder'=>'Address', 'class' => 'form-control' ,'required')) }}
=======
                            {{ Form::textarea('address', $sysSetting['address'], array('placeholder'=>'Address', 'class' => 'form-control' , 'rows' => '5', 'cols' => '4','required')) }}
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
<<<<<<< HEAD
                        <div class="col-lg-9">
                            {{ Form::text('phone', null, array('placeholder'=>'Phone', 'class' => 'form-control' )) }}
=======
                        <div class="col-lg-10">
<<<<<<< HEAD
                            {{ Form::text('phone_number', $current_cmpny_ss->phone_number, array('placeholder'=>'Phone', 'class' => 'form-control' ,'required')) }}
=======
                            {{ Form::text('phone_number', $sysSetting['phone_number'], array('placeholder'=>'Phone', 'class' => 'form-control' ,'required')) }}
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
<<<<<<< HEAD
                        <div class="col-lg-9">
                            {{ Form::text('email', null, array('placeholder'=>'Email', 'class' => 'form-control' )) }}
=======
                        <div class="col-lg-10">
<<<<<<< HEAD
                            {{ Form::text('email', $current_cmpny_ss->email, array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
=======
                            {{ Form::text('email', $sysSetting['email'], array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Language</label>
<<<<<<< HEAD
                        <div class="col-lg-10">
                            {{ Form::text('language', $current_cmpny_ss->language, array('placeholder'=>'Language', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Files</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="file">
                        </div>
=======
<<<<<<< HEAD
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
=======
                        <div class="col-lg-10">
                            {{ Form::text('language', $sysSetting['language'], array('placeholder'=>'Language', 'class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">File</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="image">
                        </div>
>>>>>>> 215036aa13d1e03c5c19efe5f43c4f0f16086f22
>>>>>>> a5663829eccc10ad7906c586676bc11794de2fb5
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