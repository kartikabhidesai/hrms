@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <style type="text/css">
            .col-lg-2.control-label.pull-right {
                margin-right: 248px;
                margin-top: -43px;
            }
        </style>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit form</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'editCompany' )) }}
                    <div class="form-group"><label class="col-lg-2 control-label"> Name</label>
                        <div class="col-lg-9">
                            {{ Form::text('company_name', $detail->company_name, array('class' => 'form-control first_name' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            {{ Form::text('email', $detail->email, array('class' => 'form-control email' ,'required', 'readonly'=>"true")) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Photo</label>
                        <div class="col-lg-6 fileinput fileinput-new input-group " data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="company_image"/>
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div> 
                        @php
                        $filename= url('uploads/client/'.$detail->company_image);
                        $file_headers = @get_headers($filename);
                        @endphp
                        @if($file_headers[0] == 'HTTP/1.1 200 OK')
                        <div class="col-lg-2 control-label pull-right"> 
                            <a href="{{ $filename }}" target="_blank" class="btn btn-sm btn-info" >View File</a>
                        </div>
                        @else
                        <div class="col-lg-2 control-label pull-right"> 
                            <a href="javascript:;" class="btn btn-sm btn-info" >View File</a>
                        </div>
                        @endif


                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-9"> 
                            {{ Form::select('status', $status, $detail->status, array('class' => 'form-control m-b', 'id' => 'status','required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subcription</label>
                        <div class="col-sm-9">
                            <select id="subcription" name="subcription" class="form-control m-b" required>
                                @if(isset($planmanagement))
                                <option value="">Select</option>
                                @foreach($planmanagement as $value)
                                @if($value->title == $detail->subcription)
                                <option value="{{$value->title}}" selected>{{$value->title}}</option>
                                @else
                                <option value="{{$value->title}}">{{$value->title}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry</label>
                        <div class="col-sm-9">
                            {{ Form::date('expiry_at', date('Y-m-d', strtotime($detail->expiry_at)), array('class' => 'form-control expiry_at','required')) }}

                        </div>
                    </div> -->
                    <div class="form-group" id="data_1">
                        <label class="col-sm-2 control-label">Expiry Date</label>
                        <div class="col-sm-9"> 
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="expiry_at" value="{{ isset($detail) && !empty($detail['expiry_at']) ? date('d-m-Y',strtotime( $detail['expiry_at'])) : '' }}" id="expiry_at" placeholder="expiry date" class="form-control expiry_at dateField" autocomplete="off">
                            </div>
                        </div>
                    </div>  
                    {{ Form::hidden('edit_id', $detail->id, array('class' => '')) }}
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