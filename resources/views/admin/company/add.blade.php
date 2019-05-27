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
                        <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                        </ul>
                        <a class="close-link">
                                <i class="fa fa-times"></i>
                        </a> -->
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addCompany' )) }}
                    <div class="form-group"><label class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-9">
                            {{ Form::text('company_name', null, array('class' => 'form-control company_name' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            {{ Form::text('email', null, array('class' => 'form-control email' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-9">
                            <input id="password" type="password" class="form-control" name="password" required>
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
                                <input  type="file" name="company_image"/>
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-9"> 
                            {{ Form::select('status', $status, null, array('class' => 'form-control m-b', 'id' => 'status','required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subcription</label>
                        <div class="col-sm-9"> 
                            <select id="subcription" name="subcription" class="form-control m-b" required>
                                @if(isset($planmanagement))
                                    
                                    @foreach($subcription as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Expiry</label>
                        <div class="col-sm-9">
                         {{ Form::date('expiry_at', null, array('class' => 'form-control expiry_at','required')) }}

                        </div>
                    </div> -->
                    <div class="form-group" id="data_1">
                        <label class="col-sm-2 control-label">Expiry Date</label>
                        <div class="col-sm-9"> 
                                    <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="expiry_at" value="{{ isset($leaveEdit) && !empty($leaveEdit['expiry_at']) ? date('d-m-Y',strtotime( $leaveEdit['start_date'])) : '' }}" id="expiry_at" placeholder="expiry date" class="form-control expiry_at dateField" autocomplete="off">
                                </div>
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