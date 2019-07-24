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
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('system_name',null, array('placeholder'=>'System Name', 'class' => 'form-control' ,'required')) }}
                            @else
                                {{ Form::text('system_name', $current_cmpny_ss->system_name, array('placeholder'=>'System Name', 'class' => 'form-control' ,'required')) }}
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">System Title</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('system_title', null, array('placeholder'=>'System Title', 'class' => 'form-control' ,'required')) }}
                            @else
                               {{ Form::text('system_title', $current_cmpny_ss->system_title, array('placeholder'=>'System Title', 'class' => 'form-control' ,'required')) }}
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::textarea('address', null, array('placeholder'=>'Address', 'class' => 'form-control' ,'required')) }} 
                            @else
                               {{ Form::textarea('address', $current_cmpny_ss->address, array('placeholder'=>'Address', 'class' => 'form-control' ,'required')) }} 
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('phone_number', null, array('placeholder'=>'Phone', 'class' => 'form-control' ,'required')) }}
                            @else
                                {{ Form::text('phone_number', $current_cmpny_ss->phone_number, array('placeholder'=>'Phone', 'class' => 'form-control' ,'required')) }}
                            @endif
                            
                            
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('email', null, array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
                            @else
                                {{ Form::text('email', $current_cmpny_ss->email, array('placeholder'=>'Email', 'class' => 'form-control' ,'required')) }}
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Language</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('language', null, array('placeholder'=>'Language', 'class' => 'form-control' ,'required')) }}
                            @else
                                {{ Form::text('language', $current_cmpny_ss->language, array('placeholder'=>'Language', 'class' => 'form-control' ,'required')) }}
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">File</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="image">
                        </div>
                         @if($current_cmpny_ss != null || $current_cmpny_ss != '')
                            @if($current_cmpny_ss->image != NULL || $current_cmpny_ss->image != "")
                            <label class="col-lg-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <a href="{{ url('uploads/systems/'.$current_cmpny_ss->image) }}" download>
                                        <label class="col-lg-3 pull-left"> {{ $current_cmpny_ss->image }}</label>
                                    </a>
                                </div>
                            @endif
                         @endif
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