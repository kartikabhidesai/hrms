@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add Department</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'department-add' )) }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Department Name</label>
                            <div class="col-lg-10">
                                    {{ Form::text('department_name', null, array('placeholder'=>'Department Name', 'class' => 'form-control department_name' )) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Manager Name</label>
                                    <div class="col-lg-8">
                                        <select class="form-control manager_name" id="manager_name" name="manager_name">
                                            <option selected="selected" value="">Select Manager Name</option>
                                            @foreach($employeelist as $key => $value)
                                                <option  value="{{ $value['name'] }} {{ $value['father_name'] }}">{{ $value['name'] }} {{ $value['father_name'] }}</option>
                                            @endforeach
                                        </select>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Co-Manager Name</label>
                                    <div class="col-lg-8">
                                        <select class="form-control comanager_name" id="comanager_name" name="comanager_name">
                                            <option selected="selected" value="">Select Manager Name</option>
                                            @foreach($employeelist as $key => $value)
                                                <option  value="{{ $value['name'] }} {{ $value['father_name'] }}">{{ $value['name'] }} {{ $value['father_name'] }}</option>
                                            @endforeach
                                        </select>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Designation</label>
                                    <div class="col-lg-8">
                                            {{ Form::text('designation[]', null, array('placeholder'=>'Designation', 'class' => 'form-control designation' ,'required')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Supervisor Name</label>
                                    <div class="col-lg-8">
                                        <select class="form-control supervisor_name" id="supervisor_name" name="supervisor_name[]">
                                            <option selected="selected" value="">Select Manager Name</option>
                                            @foreach($employeelist as $key => $value)
                                                <option  value="{{ $value['name'] }} {{ $value['father_name'] }}">{{ $value['name'] }} {{ $value['father_name'] }}</option>
                                            @endforeach
                                        </select>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="add_designation_div">
                            
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
                                <input class="btn btn-sm add_designation" type="button" value="Add More Designation">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary submitbtn" type="submit">Save Department</button>
                            </div>
                        </div>
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
	</div>
</div>
@endsection