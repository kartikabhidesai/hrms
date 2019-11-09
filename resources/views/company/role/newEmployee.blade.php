                <form method="POST" accept-charset="UTF-8" class="form-horizontal" id="addNewEmployeeRole">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="hidden">
                            <input type="text" name="companyId" value="{{ $companyId }}">
                        </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                         <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" class="employeeType" value="existingEmployee" name="employeeType" >&nbsp;Existing Employee
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" class="employeeType" value="newEmployee" name="employeeType" checked="checked">&nbsp;New Employee
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2  control-label">Basic Details</label>
                        <div class="col-lg-9">
                             
                        </div>
                    </div><hr>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Gender</label>
                            <div class="col-sm-9"> 
                                    {{ Form::select('gender', $genderArray , null, array('class' => 'form-control gender', 'id' => 'gender')) }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2  control-label">Name</label>
                        <div class="col-lg-9">
                                {{ Form::text('name', null, array('placeholder'=>'Name', 'class' => 'form-control name' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2  control-label">Father Name</label>
                        <div class="col-lg-9">
                                {{ Form::text('father_name', null, array('placeholder'=>'Father Name', 'class' => 'form-control last_name' ,'required')) }}
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-9">
                                {{ Form::text('phone', null, array('placeholder'=>'Phone', 'class' => 'form-control last_name' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Local Address</label>
                            <div class="col-lg-9">
                                    {{ Form::text('local_address', null, array('placeholder'=>'Local Address', 'class' => 'form-control address' ,'required')) }}
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Permanent Address</label>
                            <div class="col-lg-9">
                                    {{ Form::text('permanent_address', null, array('placeholder'=>'Permanent Address', 'class' => 'form-control permanent_address' ,'required')) }}
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Nationality</label>
                            <div class="col-lg-9">
                                <select class="form-control nationality" required="" id="nationality" name="nationality" aria-required="true">
                                    <option value="" selected="selected">Choose an option...</option>
                                    @for($i = 0;$i < count($nationalityArray) ; $i++ )
                                        <option value="{{ $nationalityArray[$i]->id }}">{{ $nationalityArray[$i]->country_name }}</option>
                                    
                                    @endfor
                                    
                                    
                                </select>
                                    
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Religion</label>
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
                        <label class="col-lg-2 control-label">Martial Status</label>
                        <div class="col-sm-9"> 
                        {{ Form::select('martial_status', $martialArray , null, array('class' => 'form-control martial_status', 'id' => 'martial_status')) }}
                        </div>
                    </div>    
                        
                    <hr>
                    <div class="form-group">
                        <label class="col-lg-2  control-label">Login Details</label>
                        <div class="col-lg-9">
                             
                        </div>
                    </div><hr>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                                {{ Form::text('email', null, array('placeholder'=>'Email','class' => 'form-control email' ,'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-9">
                                {{ Form::password('newpassword',array('placeholder'=>'Password','class' => 'form-control newpassword required','id'=> 'newpassword')) }}
                        </div>
                    </div>
                    
                    <hr>
                        <div class="form-group">
                            <label class="col-lg-2  control-label">Company Details</label>
                            <div class="col-lg-9">

                            </div>
                        </div><hr>
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Employee Id</label>
                                <div class="col-lg-9">
                                        {{ Form::text('employee_id', null, array('placeholder'=>'Employee Id', 'class' => 'form-control employee_id' ,'required')) }}
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="col-lg-2 control-label">Job Title</label>
                                <div class="col-lg-9">
                                        {{ Form::text('job_title', null, array('placeholder'=>'Job Title', 'class' => 'form-control job_title' ,'required')) }}
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="col-lg-2 control-label">Department</label>
                                <div class="col-lg-9">
                                        {{ Form::select('department', $ArrDepartment , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                </div>
                        </div>
                    
			<div class="form-group">
                            <label class="col-lg-2 control-label">Designation</label>
                            <div class="col-sm-9"> 
                                    {{ Form::select('designation', $ArrDesignation , null, array('placeholder'=>'Select Designation', 'class' => 'form-control designation', 'id' => 'designation')) }}
                            </div>
                        </div>
			<div class="form-group">
                            <label class="col-lg-2 control-label">Join Salary</label>
                            <div class="col-sm-9"> 
                                    {{ Form::select('join_salary', $testarray , null, array('class' => 'form-control join_salary', 'id' => 'join_salary')) }}
                            </div>
                        </div> 

			<div class="form-group">
                            <label class="col-lg-2 control-label">Status</label>
                            <div class="col-sm-9"> 
                            	{{ Form::select('status', $statusArray , null, array('class' => 'form-control status', 'id' => 'status')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Employee Type</label>
                            <div class="col-lg-9">
                                    <select class="form-control employee type" name="employee_type">
                                            <option>Select Employee Type</option>
                                            <option value="temporary">Temporary</option>
                                            <option value="permanent">Permanent</option>
                                            <option value="part-time">Part-Time</option>
                                    </select>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <label class="col-lg-2  control-label">Bank Details</label>
                            <div class="col-lg-9">

                            </div>
                        </div><hr>
                    	
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Account Holder Name</label>
                                <div class="col-lg-9">
                                        {{ Form::text('account_holder_name', null, array('class' => 'form-control account_holder_name' ,'required')) }}
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Account Number</label>
                                <div class="col-lg-9">
                                        {{ Form::text('account_number', null, array('class' => 'form-control account_number' ,'required')) }}
                                </div>
                        </div>	
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Bank name</label>
                                <div class="col-lg-9">
                                        {{ Form::text('bank_name', null, array('class' => 'form-control bank_name' ,'required')) }}
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-lg-2 control-label">Branch</label>
                                <div class="col-lg-9">
                                        {{ Form::text('branch', null, array('class' => 'form-control branch' ,'required')) }}
                                </div>
                        </div>
                    <hr>
                        <div class="form-group">
                            <label class="col-lg-2  control-label">Role Details</label>
                            <div class="col-lg-9">

                            </div>
                        </div>
                    <hr>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                        <div class="col-lg-9">
                            @php
                            $count = 1;
                            @endphp
                            @for($i = 0 ;$i < count($masterPermission);$i++,$count++)
                                <div class="c-choice c-choice--checkbox col-lg-4">
                                    <input class="roleCheckbox" value="{{ $masterPermission[$i]->id }}" id="checkbox{{ $count }}" name="role[]" type="checkbox">
                                    <label class="c-choice__label" for="checkbox{{ $count }}">{{ $masterPermission[$i]->name }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    </div>
           </form>