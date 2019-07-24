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
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'editTask' )) }}
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Department</label>
                                <div class="col-lg-10">
                                    {{ Form::select('department', $department , $editTask[0]->department_id, array('placeholder'=>'Select Depatment', 'class' => 'form-control department', 'id' => 'department')) }}
                                </div>
                            </div>
                            <input  class="form-control hidden" id="editId"  name="editId" type="text" value="3" aria-required="true" aria-describedby="editId-error" aria-invalid="false">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Assign Date</label>
                                <div class="col-lg-10">
                                    <div class="input-group assign_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="assign_date" id="from_date" placeholder="Assign Date" class="form-control assign_date dateField" value="{{ date('d-m-Y',strtotime($editTask[0]->assign_date)) }}" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Task</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" value="{{ $editTask[0]->task }}" name="task">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="location" value="{{ $editTask[0]->location }}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Employee</label>
                                <div class="col-lg-10">
                                    {{ Form::select('employee', $employee ,  $editTask[0]->employee_id, array('placeholder'=>'Select Employee', 'class' => 'form-control employee', 'id' => 'employee')) }}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Deadline Date</label>
                                <div class="col-lg-10"> 
                                    <div class="input-group deadline_date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="deadline_date" id="to_date" placeholder="Deadline Date" value="{{ date('d-m-Y',strtotime($editTask[0]->deadline_date)) }}"  class="form-control nonWorking deadline_date dateField" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div> 
                            
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Priority</label>
                                <div class="col-lg-10">
                                    <select name="priority" class="form-control">
                                        <option value="">Select Prority</option>
                                        <option value="HIGH" {{ ( $editTask[0]->priority == 'HIGH' ? 'selected="selected"' : '') }}>High</option>
                                        <option value="NORMAL" {{ ( $editTask[0]->priority == 'NORMAL' ? 'selected="selected"' : '') }}>Normal</option>
                                        <option value="LOW" {{ ( $editTask[0]->priority == 'LOW' ? 'selected="selected"' : '') }}>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="col-lg-2 control-label">About Task</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="about_task">{{ $editTask[0]->about_task }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                    
                        
                        <div class="form-group" style="margin-left: 1px;margin-right: 1px">
                            <label class="col-lg-1 control-label">Files</label>
                            <div class="col-lg-11">
                                <input type="file" class="form-control" name="file">
                            </div>
                            @if($editTask[0]->file != NULL || $editTask[0]->file != "")
                                <label class="col-lg-1 control-label"></label>
                                <div class="col-sm-11">
                                    <a href="{{ url('uploads/tasks/'.$editTask[0]->file) }}" download>
                                       <label class="col-lg-3 control-label">{{ $editTask[0]->file }}</label>
                                    </a>
                                </div>
                            @endif
                        </div>
                    <br>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">Save Task</button>
                            </div>
                        </div>
                    
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
        
	</div>
</div>


@endsection