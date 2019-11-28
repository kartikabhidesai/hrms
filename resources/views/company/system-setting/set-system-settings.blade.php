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
                                {{ Form::text('system_name',null, array('placeholder'=>'System Name', 'class' => 'form-control')) }}
                            @else
                                {{ Form::text('system_name', $current_cmpny_ss->system_name, array('placeholder'=>'System Name', 'class' => 'form-control')) }}
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">System Title</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('system_title', null, array('placeholder'=>'System Title', 'class' => 'form-control')) }}
                            @else
                               {{ Form::text('system_title', $current_cmpny_ss->system_title, array('placeholder'=>'System Title', 'class' => 'form-control')) }}
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::textarea('address', null, array('placeholder'=>'Address', 'class' => 'form-control')) }} 
                            @else
                               {{ Form::textarea('address', $current_cmpny_ss->address, array('placeholder'=>'Address', 'class' => 'form-control')) }} 
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-10">
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('phone_number', null, array('placeholder'=>'Phone', 'class' => 'form-control')) }}
                            @else
                                {{ Form::text('phone_number', $current_cmpny_ss->phone_number, array('placeholder'=>'Phone', 'class' => 'form-control')) }}
                            @endif
                            
                            
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                {{ Form::text('email', null, array('placeholder'=>'Email', 'class' => 'form-control')) }}
                            @else
                                {{ Form::text('email', $current_cmpny_ss->email, array('placeholder'=>'Email', 'class' => 'form-control')) }}
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Language</label>
                        <div class="col-lg-10">
                            
                            @if($current_cmpny_ss == null || $current_cmpny_ss == '')
                                <select class="form-control" id="language" name="language">
                                    <option value="">Select Language</option>
                                    <option value="English">English</option>
                                    <option value="Arabic">Arabic</option>
                                </select>
                            @else
                                <select class="form-control" id="language" name="language">
                                    <option value="" >Select Language</option>
                                    <option value="English" {{ $current_cmpny_ss->language== 'English' ? 'selected' : '' }}>English</option>
                                    <option value="Arabic" {{ $current_cmpny_ss->language == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                </select>
                            
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
                                    <a href="#deleteImage" style="color:red" data-toggle="modal" data-image="{{ $current_cmpny_ss->image }}" data-id="{{ $current_cmpny_ss->id }}" class="pull-right deleteimage"><i class="fa fa-times-circle"></i></a>
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
<div id="deleteImage" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Image</h3>
                        <b>Are You sure want to delete image.</b><br/>
                        <form role="form">
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right yes-sure-image m-l" type="button"><strong><i class="fa fa-trash"></i> Delete </strong></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection