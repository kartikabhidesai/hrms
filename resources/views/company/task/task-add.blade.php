@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add Task</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addTask' )) }}
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Department</label>
                                <div class="col-lg-10">
                                    {{ Form::select('department', $department , null, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Assign Date</label>
                                <div class="col-lg-10">
                                    <div class="input-group assign_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="assign_date" id="from_date" placeholder="Assign Date" class="form-control assign_date dateField" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Task</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="task">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="location">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Employee</label>
                                <div class="col-lg-10 employeeHtml">
                                    {{ Form::select('employee', $employee , null, array('placeholder'=>'Select Employee', 'class' => 'form-control employee', 'id' => 'employee')) }}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Deadline Date</label>
                                <div class="col-lg-10"> 
                                    <div class="input-group deadline_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="deadline_date" id="to_date" placeholder="Deadline Date" class="form-control nonWorking deadline_date dateField" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div> 
                            
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Priority</label>
                                <div class="col-lg-10">
                                    <select name="priority" class="form-control">
                                        <option value="">Select Prority</option>
                                        <option value="HIGH">High</option>
                                        <option value="NORMAL">Normal</option>
                                        <option value="LOW">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                    <label class="col-lg-2 control-label">About Task</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="about_task"></textarea>
                                    </div>
                            </div>
                        </div>
                        
                        
                    
                        
                        <div class="form-group" style="margin-left: 1px;margin-right: 1px">
                                <label class="col-lg-1 control-label">Files</label>
                                <div class="col-lg-11">
                                    <input type="file" class="form-control" name="file">
                                </div>
                        </div>
                    <br>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="col-lg-1 control-label">&nbsp;</label>
                                 <div class="col-lg-offset-1 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Send Task</button>
                                </div>
                            </div>
                           
                        </div>
                    
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
        
	</div>
</div>


@endsection