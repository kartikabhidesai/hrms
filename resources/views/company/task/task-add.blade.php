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
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'department-add' )) }}
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Department</label>
                                <div class="col-lg-10">
                                    <select name="department" class="form-control">
                                        <option value="">Select Department</option>
                                        <option value="1">Web</option>
                                        <option value="2">Mobile</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Assign Date</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="assign_date">
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Task</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="task">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Designation</label>
                                <div class="col-lg-10">
                                    <select name="department" class="form-control">
                                        <option value="">Select Employee</option>
                                        <option value="1">Parthenon</option>
                                        <option value="2">Max</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Assign Date</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="assign_date">
                                </div>
                            </div> 
                            
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Priority</label>
                                <div class="col-lg-10">
                                    <select name="department" class="form-control">
                                        <option value="">Select Employee</option>
                                        <option value="1">High</option>
                                        <option value="2">Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-left: 1px;margin-right: 1px">
                                <label class="col-lg-1 control-label">About Task</label>
                                <div class="col-lg-11">
                                    <textarea class="form-control" name="about_tS"></textarea>
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
                            <div class="col-lg-offset-1 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">Save Department</button>
                            </div>
                        </div>
                    
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
        
	</div>
</div>
@endsection