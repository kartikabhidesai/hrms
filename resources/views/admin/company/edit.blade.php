@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
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
                            {{ Form::text('email', $detail->email, array('class' => 'form-control email' ,'required')) }}
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
                                <input type="file" name="company_image"/>
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div> 
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-9"> 
                                {{ Form::select('status', $status, $detail->status, array('class' => 'form-control m-b', 'id' => 'status','required')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Subcription</label>
                            <div class="col-sm-9"> 
                                {{ Form::select('subcription', $subcription, $detail->subcription, array('class' => 'form-control m-b', 'id' => 'subcription' ,'required')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry</label>
                        <div class="col-sm-9">
                            {{ Form::date('expiry_at', date('Y-m-d', strtotime($detail->expiry_at)), array('class' => 'form-control expiry_at','required')) }}

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