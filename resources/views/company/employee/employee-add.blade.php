@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addEmployee' )) }}
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Basic Details</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
						<div class="form-group">
							<label class="col-lg-3 control-label">Name</label>
							<div class="col-lg-9">
								{{ Form::text('name', null, array('placeholder'=>'Name', 'class' => 'form-control name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Father Name</label>
							<div class="col-lg-9">
								{{ Form::text('father_name', null, array('placeholder'=>'Father Name', 'class' => 'form-control last_name' ,'required')) }}
							</div>
						</div>
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Gender</label>
                                <div class="col-sm-9"> 
                                	{{ Form::select('gender', $genderArray , null, array('class' => 'form-control gender', 'id' => 'gender')) }}
                                </div>
                        </div>
                        <div class="form-group" id="data_1">
						 		<label class="col-sm-3 control-label">Date Of birth</label>
                                <div class="col-sm-9"> 
                                	<div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_birth" id="" placeholder="Select Date of joingng" class="form-control" value="" autocomplete="off">
                                </div>
                                </div>
                            </div>
                        <div class="form-group">
                        	<label class="col-lg-3 control-label">Phone</label>
							<div class="col-lg-9">
								{{ Form::text('phone', null, array('placeholder'=>'Phone', 'class' => 'form-control last_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Local Address</label>
							<div class="col-lg-9">
								{{ Form::text('local_address', null, array('placeholder'=>'Local Address', 'class' => 'form-control address' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Permanent Address</label>
							<div class="col-lg-9">
								{{ Form::text('permanent_address', null, array('placeholder'=>'Permanent Address', 'class' => 'form-control permanent_address' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Nationality</label>
							<div class="col-lg-9">
								{{ Form::select('nationality', $nationalityArray , null , array('class' => 'form-control nationality','required', 'id' => 'nationality')) }}
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Religion</label>
							<div class="col-lg-9">
								<select class="form-control dropdown" id="religion" name="religion">
								    <option value="" selected="selected" disabled="disabled">-- select one --</option>
								    <option value="African Traditional &amp; Diasporic">African Traditional &amp; Diasporic</option>
								    <option value="Agnostic">Agnostic</option>
								    <option value="Atheist">Atheist</option>
								    <option value="Baha'i">Baha'i</option>
								    <option value="Buddhism">Buddhism</option>
								    <option value="Cao Dai">Cao Dai</option>
								    <option value="Chinese traditional religion">Chinese traditional religion</option>
								    <option value="Christianity">Christianity</option>
								    <option value="Hinduism">Hinduism</option>
								    <option value="Islam">Islam</option>
								    <option value="Jainism">Jainism</option>
								    <option value="Juche">Juche</option>
								    <option value="Judaism">Judaism</option>
								    <option value="Neo-Paganism">Neo-Paganism</option>
								    <option value="Nonreligious">Nonreligious</option>
								    <option value="Rastafarianism">Rastafarianism</option>
								    <option value="Secular">Secular</option>
								    <option value="Shinto">Shinto</option>
								    <option value="Sikhism">Sikhism</option>
								    <option value="Spiritism">Spiritism</option>
								    <option value="Tenrikyo">Tenrikyo</option>
								    <option value="Unitarian-Universalism">Unitarian-Universalism</option>
								    <option value="Zoroastrianism">Zoroastrianism</option>
								    <option value="primal-indigenous">primal-indigenous</option>
								    <option value="Other">Other</option>
								</select>
							</div>
						</div>
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Martial Status</label>
                                <div class="col-sm-9"> 
                                {{ Form::select('martial_status', $martialArray , null, array('class' => 'form-control martial_status', 'id' => 'martial_status')) }}
                                </div>
                            </div>
                        <div class="form-group">
							<label class="col-lg-3 control-label">Photo</label>
								  <div class="col-sm-9"> 
                                <div class="fileinput fileinput-new input-group " data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="emp_pic"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Driver License</label>
						  	<div class="col-sm-9"> 
                            	<div class="fileinput fileinput-new input-group " data-provides="fileinput">
							    	<div class="form-control" data-trigger="fileinput">
							        	<i class="glyphicon glyphicon-file fileinput-exists"></i>
							    		<span class="fileinput-filename"></span>
							    	</div>
								    <span class="input-group-addon btn btn-default btn-file">
								        <span class="fileinput-new">Select file</span>
								        <span class="fileinput-exists">Change</span>
								        <input type="file" name="driver_license"/>
								    </span>
						    		<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">National ID</label>
								  <div class="col-sm-9"> 
                                <div class="fileinput fileinput-new input-group " data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="national_id"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Iqama ID</label>
								  <div class="col-sm-9"> 
                                <div class="fileinput fileinput-new input-group " data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="iqama_id"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Iqama expire date</label>
							<div class="col-lg-9">
								<div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="iqama_expire_date" id="" placeholder="Select Iqama expire date" class="form-control" value=""  autocomplete="off">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Passport</label>
								  <div class="col-sm-9"> 
                                <div class="fileinput fileinput-new input-group " data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="passport"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Passport Expire Date</label>
							<div class="col-lg-9">
								<div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="passport_expire_date" id="" placeholder="Select passport expire date" class="form-control" value=""  autocomplete="off">
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>	
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Login Details</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					 
						<div class="form-group">
							<label class="col-lg-3 control-label">Email</label>
							<div class="col-lg-9">
								{{ Form::text('email', null, array('placeholder'=>'Email','class' => 'form-control email' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Password</label>
							<div class="col-lg-9">
								{{ Form::password('newpassword',array('placeholder'=>'Password','class' => 'form-control newpassword required','id'=> 'newpassword')) }}
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Company Details</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					 
						<div class="form-group">
							<label class="col-lg-3 control-label">Employee Id</label>
							<div class="col-lg-9">
								{{ Form::text('employee_id', null, array('placeholder'=>'Employee Id', 'class' => 'form-control employee_id' ,'required')) }}
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Job Title</label>
							<div class="col-lg-9">
								{{ Form::text('job_title', null, array('placeholder'=>'Job Title', 'class' => 'form-control job_title' ,'required')) }}
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Department</label>
							<div class="col-lg-9">
								{{ Form::select('department', $ArrDepartment , null, array('placeholder'=>'Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
							</div>
						</div>
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Designation</label>
                                <div class="col-sm-9"> 
                                	{{ Form::select('designation', $ArrDesignation , null, array('placeholder'=>'Designatopn', 'class' => 'form-control designation', 'id' => 'designation')) }}
                                </div>
                        </div>
						 	<div class="form-group" id="data_1">
						 		<label class="col-sm-3 control-label">Date Of joining</label>
                                <div class="col-sm-9"> 
                                	<div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="doj" id="" placeholder="Select Date of joingng" class="form-control" value=""  autocomplete="off">
                                </div>
                                </div>
                            </div>
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Join Salary</label>
                                <div class="col-sm-9"> 
                                	{{ Form::select('join_salary', $testarray , null, array('class' => 'form-control join_salary', 'id' => 'join_salary')) }}
                                </div>
                        </div> 

					 	<div class="form-group">
					 		<label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9"> 
                            	{{ Form::select('status', $statusArray , null, array('class' => 'form-control status', 'id' => 'status')) }}
                            </div>
                        </div>

                        <div class="form-group">
							<label class="col-lg-3 control-label">Employee Type</label>
							<div class="col-lg-9">
								<select class="form-control employee type" name="employee_type">
									<option>Select Employee Type</option>
									<option value="temporary">Temporary</option>
									<option value="permanent">Permanent</option>
									<option value="part-time">Part-Time</option>
								</select>
							</div>
						</div>

                    	<div class="form-group">
					 		<label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-9">
                            	&nbsp;
                            </div>
                        </div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Document</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					 
					  <div class="form-group">
							<label class="col-lg-3 control-label">Resume</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="resume"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>
						  <div class="form-group">
							<label class="col-lg-3 control-label">Offer Letter</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="offer_latter"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>
						  <div class="form-group">
							<label class="col-lg-3 control-label">Joining Letter</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="join_letter"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>
						  <div class="form-group">
							<label class="col-lg-3 control-label">Contect & Agerement</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="contect_agre"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>

						  <div class="form-group">
							<label class="col-lg-3 control-label">Other</label>
								<div class="fileinput fileinput-new input-group col-lg-9" data-provides="fileinput">
							    <div class="form-control" data-trigger="fileinput">
							        <i class="glyphicon glyphicon-file fileinput-exists"></i>
							    <span class="fileinput-filename"></span>
							    </div>
							    <span class="input-group-addon btn btn-default btn-file">
							        <span class="fileinput-new">Select file</span>
							        <span class="fileinput-exists">Change</span>
							        <input type="file" name="other"/>
							    </span>
							    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div> 
						</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Bank Details</h5>
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
								<button class="btn btn-sm btn-primary" type="submit">Save</button>
							</div>
						</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
	</div>
</div>

@endsection