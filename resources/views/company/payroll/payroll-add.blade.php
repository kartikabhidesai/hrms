@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addEmployee' )) }}
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Salary Template</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
						<div class="form-group">
							<label class="col-lg-3 control-label">Salary Grade</label>
							<div class="col-lg-9">
								{{ Form::number('name', null, array('placeholder'=>'Salary Grade', 'class' => 'form-control name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Basic Salary</label>
							<div class="col-lg-9">
								{{ Form::number('father_name', null, array('placeholder'=>'Basic Salary', 'class' => 'form-control last_name' ,'required')) }}
							</div>
						</div>
							<div class="form-group">
							<label class="col-lg-3 control-label">OverTime</label>
							<div class="col-lg-9">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Department</label>
							<div class="col-lg-9">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
						</div>
						
                        <div class="form-group" id="data_1">
						 		<label class="col-sm-3 control-label">Due Date</label>
                                <div class="col-sm-9"> 
                                	<div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_birth" id="" placeholder="Select Date of joingng" class="form-control" value="">
                                </div>
                                </div>
                            </div>
				</div>
			</div>
		</div>	
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Allowances</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
						<div class="form-group">
							<label class="col-lg-3 control-label">Housing:</label>
							<div class="col-lg-8">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
							<label class="col-lg-1 control-label">SAR</label>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Medical:</label>
							<div class="col-lg-8">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
							<label class="col-lg-1 control-label">SAR</label>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Transportation:</label>
							<div class="col-lg-8">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
							<label class="col-lg-1 control-label">SAR</label>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Travel:</label>
							<div class="col-lg-8">
								{{ Form::number('father_name', null, array('placeholder'=>'OverTime', 'class' => 'form-control last_name' ,'required')) }}
							</div>
							<label class="col-lg-1 control-label">SAR</label>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">&nbsp;</label>
							<div class="col-lg-8">
							&nbsp;
							</div>
						</div>	<div class="form-group">
							<label class="col-lg-3 control-label">&nbsp;</label>
							<div class="col-lg-8">
							&nbsp;
							</div>
						</div>
						
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Hourly Template</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
						<div class="form-group">
							<label class="col-lg-3 control-label">Amount per:</label>
							<div class="col-lg-9 m-t-sm">
								10 Hours
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Department:</label>
							<div class="col-lg-9">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Status:</label>
							<div class="col-lg-8 m-t-sm">
							Active
							</div>
							
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Employee:</label>
							<div class="col-lg-8">
							</div>
						</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Edit Bank Details</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					 
						<div class="form-group">
							<label class="col-lg-3 control-label">Account Holder Name</label>
							<div class="col-lg-9">
								{{ Form::text('account_holder_name', null, array('class' => 'form-control account_holder_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Account Number</label>
							<div class="col-lg-9">
								{{ Form::text('account_number', null, array('class' => 'form-control account_number' ,'required')) }}
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Bank name</label>
							<div class="col-lg-9">
								{{ Form::text('bank_name', null, array('class' => 'form-control bank_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Branch</label>
							<div class="col-lg-9">
								{{ Form::text('branch', null, array('class' => 'form-control branch' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-3 col-lg-9">
								<button class="btn btn-sm btn-primary" type="button">Save</button>
							</div>
						</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
	</div>
</div>

@endsection