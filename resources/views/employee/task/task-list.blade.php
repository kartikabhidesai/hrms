@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Task List</h5>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="empTaskTable">
                            <thead>
                                <tr>
                                    <!-- <th>Task ID</th> -->
                                    <th>Task Name</th>
                                    <th>Assigned Date</th>
                                    <th>Deadline Date</th>
                                    <th>Priority</th>
                                    <th>View</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="taskDetailsModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Task Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="col-sm-2 control-label">Task</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="task" placeholder="Task" class="form-control task">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="col-sm-2 control-label"> About Total </label>
                                    <div class="col-sm-9">
                                        <textarea name="about_task" class="form-control about_task"  rows="4" cols="4"></textarea>
                                    </div>
                                </div>
                            </div>


                        </form> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form role="form">
                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="updateTaskModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Task Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'updateTask' )) }}
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Complete Progress</label>
                            <div class="col-sm-9">
                                <input type="text" name="complete_progress"  class="form-control">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Task Status</label>
                            <div class="col-sm-9">
                                {{ Form::select('task_status', $task_status , null, array('class' => 'form-control m-b c-select task_status', 'id' => 'task_status')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group" style="margin-left: 1px;margin-right: 1px">
                                <label class="col-lg-2 control-label">Files</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="emp_updated_file">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <button class="btn btn-sm btn-primary pull-right updatetask" type="submit">Update</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form role="form">
                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection