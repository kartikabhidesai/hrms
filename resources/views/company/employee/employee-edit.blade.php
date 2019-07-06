@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'editEmployee' )) }}
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
                                                {{ Form::text('name', $details->name , array('placeholder'=>'Name', 'class' => 'form-control first_name' ,'required')) }}
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">Father Name</label>
                                        <div class="col-lg-9">
                                                {{ Form::text('father_name', $details->father_name, array('placeholder'=>'Father Name', 'class' => 'form-control last_name' ,'required')) }}
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-9"> 
                                                {{ Form::select('gender', $genderArray , $details->gender, array('class' => 'form-control gender', 'id' => 'gender')) }}
                                        </div>
                                </div>
                                
                                <div class="form-group" id="data_1">
                                                                    <label class="col-sm-3 control-label">Date Of birth</label>
                                    <div class="col-sm-9"> 
                                            <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_birth" id="" placeholder="Select Date of joingng" class="form-control" value="{{  date('d-m-Y',strtotime($details->date_of_birth)) }}">
                                    </div>
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">Phone</label>
                                        <div class="col-lg-9">
                                                {{ Form::text('phone', $details->phone, array('placeholder'=>'Phone', 'class' => 'form-control last_name' ,'required')) }}
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">Local Address</label>
                                        <div class="col-lg-9">
                                                {{ Form::text('local_address', $details->local_address, array('placeholder'=>'Local Address', 'class' => 'form-control address' ,'required')) }}
                                        </div>
                                </div>
                                    
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">Permanent Address</label>
                                        <div class="col-lg-9">
                                                {{ Form::text('permanent_address', $details->permanent_address, array('placeholder'=>'Permanent Address', 'class' => 'form-control permanent_address' ,'required')) }}
                                        </div>
                                </div>
						
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nationality</label>
                                    <div class="col-sm-9"> 
                                        <select class="form-control nationality" id="nationality" name="nationality">
                                            <option value="">Select Nationality</option>
                                            @for($i = 0;$i < count($nationalityArray) ;$i++)
                                                <option value="{{ $nationalityArray[$i]->id }}" {{ $details->nationality == $nationalityArray[$i]->id ? 'selected' : '' }}>{{ $nationalityArray[$i]->country_name }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Religion</label>
                                    <div class="col-lg-9">
                                        <select class="form-control dropdown" id="religion" name="religion">
                                            <option value="" selected="selected" disabled="disabled">-- select one --</option>
                                            <option value="African Traditional &amp; Diasporic" {{ $details->religion == 'African Traditional &amp; Diasporic' ? 'selected' : '' }}>African Traditional &amp; Diasporic</option>
                                            <option value="Agnostic" {{ $details->religion == 'Agnostic' ? 'selected' : '' }}>Agnostic</option>
                                            <option value="Atheist" {{ $details->religion == 'Atheist' ? 'selected' : '' }}>Atheist</option>
                                            <option value="Baha'i" {{ $details->religion == "Baha'i" ? 'selected' : '' }}>Baha'i</option>
                                            <option value="Buddhism" {{ $details->religion == "Buddhism" ? 'selected' : '' }}>Buddhism</option>
                                            <option value="Cao Dai" {{ $details->religion == "Cao Dai" ? 'selected' : '' }}>Cao Dai</option>
                                            <option value="Chinese traditional religion" {{ $details->religion == "Chinese traditional religion" ? 'selected' : '' }}>Chinese traditional religion</option>
                                            <option value="Christianity" {{ $details->religion == "Christianity" ? 'selected' : '' }}>Christianity</option>
                                            <option value="Hinduism" {{ $details->religion == "Hinduism" ? 'selected' : '' }}>Hinduism</option>
                                            <option value="Islam" {{ $details->religion == "Islam" ? 'selected' : '' }}>Islam</option>
                                            <option value="Jainism" {{ $details->religion == "Jainism" ? 'selected' : '' }}>Jainism</option>
                                            <option value="Juche" {{ $details->religion == "Juche" ? 'selected' : '' }}>Juche</option>
                                            <option value="Judaism" {{ $details->religion == "Judaism" ? 'selected' : '' }}>Judaism</option>
                                            <option value="Neo-Paganism" {{ $details->religion == "Neo-Paganism" ? 'selected' : '' }}>Neo-Paganism</option>
                                            <option value="Nonreligious" {{ $details->religion == "Nonreligious" ? 'selected' : '' }}>Nonreligious</option>
                                            <option value="Rastafarianism" {{ $details->religion == "Rastafarianism" ? 'selected' : '' }}>Rastafarianism</option>
                                            <option value="Secular" {{ $details->religion == "Secular" ? 'selected' : '' }}>Secular</option>
                                            <option value="Shinto" {{ $details->religion == "Shinto" ? 'selected' : '' }}>Shinto</option>
                                            <option value="Sikhism" {{ $details->religion == "Sikhism" ? 'selected' : '' }}>Sikhism</option>
                                            <option value="Spiritism" {{ $details->religion == "Spiritism" ? 'selected' : '' }}>Spiritism</option>
                                            <option value="Tenrikyo" {{ $details->religion == "Tenrikyo" ? 'selected' : '' }}>Tenrikyo</option>
                                            <option value="Unitarian-Universalism" {{ $details->religion == "Unitarian-Universalism" ? 'selected' : '' }}>Unitarian-Universalism</option>
                                            <option value="Zoroastrianism" {{ $details->religion == "Zoroastrianism" ? 'selected' : '' }}>Zoroastrianism</option>
                                            <option value="primal-indigenous" {{ $details->religion == "primal-indigenous" ? 'selected' : '' }}>primal-indigenous</option>
                                            <option value="Other" {{ $details->religion == "Other" ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Martial Status</label>
                                    <div class="col-sm-9"> 
                                    {{ Form::select('martial_status', $martialArray , $details->martial_status , array('class' => 'form-control martial_status', 'id' => 'martial_status')) }}
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
                                    @if($details->photo != NULL || $details->photo != "")
                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                        <div class="col-sm-9">
                                            <a href="{{ url('uploads/client/'.$details->photo) }}" download>
                                               <label class="col-lg-3 control-label"> {{ $details->photo }}</label>
                                            </a>
                                        </div>
                                    @endif
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
                                @if($details->driver_license != NULL || $details->driver_license != "")
                                <label class="col-lg-3 control-label">&nbsp;</label>
                                    <div class="col-sm-9">
                                        <a href="{{ url('uploads/client/'.$details->driver_license) }}" download>
                                            <label class="col-lg-3 pull-left"> {{ $details->driver_license }}</label>
                                        </a>
                                    </div>
                                </div>
                                @endif
						<div class="form-group appId">
                                                    <label class="col-lg-3 control-label">ID</label>
                                                    <div class="col-sm-9"> 
                                                        <select class="form-control selectId" id="national_id" name="national_id">
                                                            <option value="">Select National ID or Iqama ID</option>
                                                            <option value="1" {{ $details->type_of_id == 1 ? 'selected' : '' }}>National ID</option>
                                                            <option value="2" {{ $details->type_of_id == 2 ? 'selected' : '' }}>Iqama ID</option>
                                                        </select>
                                                    </div>
						</div>
                                    
                                                <div class="typeDiv">
                                                    @if( $details->type_of_id == 1)
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">National ID</label>
                                                                <div class="col-sm-9">
                                                                    <input placeholder="National Id" class="form-control id" required="" name="id" value="{{ $details->natonal_iqama_id }}" type="text" aria-required="true">
                                                                </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group">+
                                                            <label class="col-lg-3 control-label">Iqama ID</label>
                                                                <div class="col-sm-9">
                                                                    <input placeholder="Iqama Id" class="form-control id" required="" name="id" type="text" value="{{ $details->natonal_iqama_id }}" aria-required="true">
                                                                </div>
                                                        </div>
                                                    @endif
                                                </div>
                                    
						<div class="form-group">
                                                    <label class="col-lg-3 control-label">Iqama expire date</label>
                                                    <div class="col-lg-9">
                                                            <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="iqama_expire_date" placeholder="Select Iqama expire date" class="form-control" value="{{ date('d-m-Y',strtotime($details->iqama_expire_date)) }}" autocomplete="off">
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
                                                    <label class="col-lg-3 control-label">&nbsp;</label>
                                                    <div class="col-sm-9">
                                                        <a href="{{ url('uploads/client/'.$details->passport) }}" download>
                                                            <label class="col-lg-3 pull-left"> {{ $details->passport }}</label>
                                                        </a>
                                                    </div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Passport Expire Date</label>
							<div class="col-lg-9">
								<div class="input-group date">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="passport_expire_date" placeholder="Select passport expire date" class="form-control" value="{{ date('d-m-Y',strtotime($details->passport_expire_date)) }}" autocomplete="off">
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
								{{ Form::text('email', $details->email , array('placeholder'=>'Email','class' => 'form-control email' ,'readonly')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Password</label>
							<div class="col-lg-9">
                                                                <input placeholder="Password" class="form-control newpassword " id="newpassword" name="newpassword" type="password" value="{{  $details->natonal_iqama_id }}">
								
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
								{{ Form::text('employee_id', $details->employee_id, array('placeholder'=>'Employee Id', 'class' => 'form-control employee_id' ,'required')) }}
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Job Title</label>
							<div class="col-lg-9">
								{{ Form::text('job_title', $details->job_title, array('placeholder'=>'Job Title', 'class' => 'form-control job_title' ,'required')) }}
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Department</label>
							<div class="col-lg-9">
								{{ Form::select('department', $ArrDepartment , $details->department, array('placeholder'=>'Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
							</div>
						</div>
						<input type="hidden" name="oldpassword" value="{{  $details->password }}">
						<input type="hidden" name="editId" value="{{  $details->id }}">
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Designation</label>
                                <div class="col-sm-9"> 
                                	{{ Form::select('designation', $ArrDesignation , $details->designation, array('placeholder'=>'Designatopn', 'class' => 'form-control designation', 'id' => 'designation')) }}
                                </div>
                       		</div>
						 	<div class="form-group" id="data_1">
						 		<label class="col-sm-3 control-label">Date Of joining</label>
                                <div class="col-sm-9"> 
                                	<div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="doj" placeholder="Select Date of joingng" class="form-control" value="{{  date('d-m-Y',strtotime($details->date_of_joining)) }}">
                                </div>
                                </div>
                            </div>
                                                
                            <div class="form-group">
                                    <label class="col-sm-3 control-label">Join Salary</label>
                                    <div class="col-sm-9"> 
                                        <select class="form-control join_salary" id="join_salary" name="join_salary" aria-required="true" aria-describedby="join_salary-error" aria-invalid="false">
                                                <option value="">Select Join Salary</option>
                                                @for($i = 0 ;$i < count($testarray) ;$i++)
                                                    <option value="{{ $testarray[$i]['id'] }}" {{ $details->joining_salary == $testarray[$i]['id'] ? 'selected' : '' }}>{{ $testarray[$i]['grade'] }}</option>
                                                @endfor
                                        </select>

                                    </div>
                            </div> 
						 	<div class="form-group">
						 		<label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9"> 
                                	{{ Form::select('status', $statusArray , $details->status, array('class' => 'form-control status', 'id' => 'status')) }}
                                </div>
                        </div>

                        <div class="form-group">
							<label class="col-lg-3 control-label">Employee Type</label>
							<div class="col-lg-9">
								<select class="form-control employee type" name="employee_type">
									<option>Select Employee Type</option>
									<option value="temporary" {{ $details->employee_type == 'temporary' ? 'selected' : '' }}>Temporary</option>
									<option value="permanent" {{ $details->employee_type == 'permanent' ? 'selected' : '' }}>Permanent</option>
									<option value="part-time" {{ $details->employee_type == 'part-time' ? 'selected' : '' }}>Part-Time</option>
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
                                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                                        <div class="col-sm-9">
                                                            <a href="{{ url('uploads/client/'.$details->resume_file) }}" download>
                                                                <label class="col-lg-3 pull-left"> {{ $details->resume_file }}</label>
                                                            </a>
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
                                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                                        <div class="col-sm-9">
                                                            <a href="{{ url('uploads/client/'.$details->offer_letter) }}" download>
                                                                <label class="col-lg-3 pull-left"> {{ $details->offer_letter }}</label>
                                                            </a>
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
                                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                                        <div class="col-sm-9">
                                                            <a href="{{ url('uploads/client/'.$details->joining_letter) }}" download>
                                                                <label class="col-lg-3 pull-left"> {{ $details->joining_letter }}</label>
                                                            </a>
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
                                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                                        <div class="col-sm-9">
                                                            <a href="{{ url('uploads/client/'.$details->contact_agreement) }}" download>
                                                                <label class="col-lg-3 pull-left"> {{ $details->contact_agreement }}</label>
                                                            </a>
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
                                                        <label class="col-lg-3 control-label">&nbsp;</label>
                                                        <div class="col-sm-9">
                                                            <a href="{{ url('uploads/client/'.$details->other) }}" download>
                                                                <label class="col-lg-3 pull-left"> {{ $details->other }}</label>
                                                            </a>
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
								{{ Form::text('account_holder_name', $details->account_holder_name, array('class' => 'form-control account_holder_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Account Number</label>
							<div class="col-lg-9">
								{{ Form::text('account_number', $details->account_number, array('class' => 'form-control account_number' ,'required')) }}
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-3 control-label">Bank name</label>
							<div class="col-lg-9">
								{{ Form::text('bank_name', $details->bank_name, array('class' => 'form-control bank_name' ,'required')) }}
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Branch</label>
							<div class="col-lg-9">
								{{ Form::text('branch', $details->branch, array('class' => 'form-control branch' ,'required')) }}
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