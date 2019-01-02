@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add form</h5>
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
					 {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'updateProfile' )) }}
						<div class="form-group">
							<label class="col-lg-2 control-label">Name</label>
							<div class="col-lg-9">
								{{ Form::text('first_name', $detail->name, array('class' => 'form-control first_name' ,'required')) }}
							</div>
						</div>
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-lg-2 control-label">Email</label>
							<div class="col-lg-9">
								{{ Form::text('email', $detail->email, array('class' => 'form-control email' ,'readonly'=>'true')) }}
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-2 control-label">Password</label>
							<div class="col-lg-9">
								{{ Form::password('newpassword',array('placeholder'=>'Password','class' => 'form-control newpassword','id'=> 'newpassword')) }}
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-2 control-label">Confirm Password</label>
							<div class="col-lg-9">
								{{ Form::password('cpassword',array('placeholder'=>'Confirm Password','class' => 'form-control repassword','id'=> 'repassword')) }}
								{{ Form::hidden('editid',$detail->id,array()) }}
								{{ Form::hidden('oldpassword',$detail->password,array()) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">File</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="profile_pic"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
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