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
					 {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'editDemo' )) }}
						<div class="form-group"><label class="col-lg-2 control-label">First Name</label>
							<div class="col-lg-9">
								{{ Form::text('first_name', $detail->first_name, array('class' => 'form-control first_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group"><label class="col-lg-2 control-label">Last Name</label>
							<div class="col-lg-9">
								{{ Form::text('last_name', $detail->last_name, array('class' => 'form-control last_name' ,'required')) }}
								
							</div>
						</div>
						{{ Form::hidden('edit_id', $detail->id, array('class' => '')) }}
						<div class="form-group">
							<label class="col-lg-2 control-label">File</label>
								<div class="fileinput fileinput-new input-group col-lg-7" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="demo_pic"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>
						
                        <div class="form-group">
						 	<div class="form-group">
						 		<label class="col-sm-2 control-label">Select</label>
                                <div class="col-sm-9">
                                    {{ Form::select('testarray', $testarray , null, array('class' => 'form-control m-b', 'id' => 'test')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
						 	<label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"> 
                                {{ Form::radio('gender', 'M', array('class' => 'form-control male' ,'id'=>'male')) }} Male</label>
                            	<label class="radio-inline">
                                {{ Form::radio('gender', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} Female</label>
                                    </div>
                        </div>	
                        <div class="form-group">
						 	<label class="col-sm-2 control-label">checkbox</label>
                            <div class="col-sm-9">
                                <label class="checkbox-inline"> 
                                {{ Form::checkbox('hb', 'M', array('class' => 'form-control male' ,'id'=>'male')) }} checkbox1</label>
                            	<label class="checkbox-inline">
                                {{ Form::checkbox('hb', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} checkbox2</label>
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