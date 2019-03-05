@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add Training</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
                <style type="text/css">
                    .mr-1{
                        margin-right: 1px !important;
                    }
                </style>
				<div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addTraining' )) }}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="location" placeholder="Location">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Budget </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="budget" placeholder="Budget">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Requinment</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="requinment" placeholder="Requinment" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Department</label>
                                <div class="col-lg-10">
                                    {{ Form::select('department', $department , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Number </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="number" placeholder="Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Types</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="types" placeholder="Types" >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="row">
                                <H2 class="col-lg-12 center-align">Employee Info</H2>
                                
                             </div>
                            <div class="row">
                                <label class="col-lg-1"></label>
                                <label class="col-lg-3">Employee Name:</label>
                                <label class="col-lg-3">Department </label>
                                <label class="col-lg-3">Employee Info</label>
                                <label class="col-lg-2"></label>
                             </div>
                             <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="employee_name" placeholder="Employee Name">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        {{ Form::select('department', $department , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        {{ Form::select('department', $department , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                        <input type="text" class="form-control" name="employee_info" placeholder="Employee Info" >
                                    </div>
                                </div>
                                 <div class="col-lg-2" style="text-align: center;">
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="employee_name" placeholder="Employee Name">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="department" placeholder="Department">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="employee_info" placeholder="Employee Info" >
                                    </div>
                                </div>
                                <div class="col-lg-2" style="text-align: center;">
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="employee_name" placeholder="Employee Name">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="department" placeholder="Department">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mr-1">
                                        <input type="text" class="form-control" name="employee_info" placeholder="Employee Info" >
                                    </div>
                                </div>
                                 <div class="col-lg-2" style="text-align: center;">
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10"></div>
                                
                                 <div class="col-lg-2" style="text-align: center;">
                                      <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-plus"></i></button>
                                 </div>
                            </div>
                        </div>
                        
                       
                    <br>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">Save Training</button>
                            </div>
                        </div>
                    
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
        
	</div>
</div>
@endsection