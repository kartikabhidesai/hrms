@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-3 ">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right"></span>
                    <h5>New Task</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $new }}</h1>
                    <div class="stat-percent font-bold text-success"></div>
                    <small></small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Pending Task</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $pending }}</h1>
                    <div class="stat-percent font-bold text-info"></div>
                    <small></small>
                </div>
            </div>
        </div>
        
         <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>In progress Task</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $progress }}</h1>
                    <div class="stat-percent font-bold text-info"></div>
                    <small></small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right"></span>
                    <h5>Completed Task</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $complete }}</h1>
                    <div class="stat-percent font-bold text-success"></div>
                    <small></small>
                </div>
            </div>
        </div>

       
    </div>
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Task List</h5>
                    <!-- <div class="ibox-tools">
                            <a href="{{ route('add-task') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                    </div> -->
                </div>
                
                <div class="ibox-content">
                    <div class="table-responsive">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'filtter' )) }}
                        <div class="ibox-tools col-sm-12">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Priority</label>
                                <div class="col-lg-10">
                                    <select name="department" id="priority" class="form-control priority">
                                        <option value="">Select Priority</option>
                                        <option value="HIGH" {{ ( $priority == 'HIGH' ? 'selected="selected"' : '') }}>High</option>
                                        <option value="NORMAL" {{ ( $priority == 'NORMAL' ? 'selected="selected"' : '') }}>Normal</option>
                                        <option value="LOW" {{ ( $priority == 'LOW' ? 'selected="selected"' : '') }}>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ibox-tools col-sm-12">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <select name="department" id="status" class="form-control status">
                                        <option value="">Select Status</option>
                                        <option value="0" {{ ( $status == '0' ? 'selected="selected"' : '') }}>New</option>
                                        <option value="1" {{ ( $status == '1' ? 'selected="selected"' : '') }}>In Progess</option>
                                        <option value="2" {{ ( $status == '2' ? 'selected="selected"' : '') }}>Pending</option>
                                        <option value="3" {{ ( $status == '3' ? 'selected="selected"' : '') }}>Complete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-tools col-sm-12">
                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <button class="btn btn-sm btn-primary filler pull-left" style="margin-left: 15px;"type="button">Apply</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                        <div class="ibox-tools">
                            <a href="{{ route('add-task') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="taskTable">
                            <thead>
                                <tr>
                                    <!-- <th>Task ID</th> -->
                                    <th>Task Name</th>
                                    <th>Assigned To</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Complete Progress</th>
                                    <th>Info</th>
                                    <th>Location</th>
                                    <th>Emoloyee File</th>
                                    <th>Action</th>
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Task Details</h3>
                            <br/>
                            <!-- <b>Employee Name: </b><span class="m-t-none m-b empName"></span><br/> -->
                            <div class="taskNameDiv">
                                <b>Task Name: </b><span class="m-t-none m-b taskName"></span><br/>
                            </div>
                            <div class="assignedToDiv">
                                <b>Assigned To: </b><span class="m-t-none m-b assignedTo"></span><br/>
                            </div>
                            <div class="priorityDiv">
                                <b>Priority: </b><span class="m-t-none m-b priority"></span><br/>
                            </div>
                            <div class="statusDiv">
                                <b>Status: </b><span class="m-t-none m-b status"></span><br/>
                            </div>
                            <div class="progressDiv">
                                <b>Complete Progress: </b><span class="m-t-none m-b progress"></span><br/>
                            </div>
                            <div class="infoDiv">
                                <b>Info: </b><span class="m-t-none m-b info"></span><br/>
                            </div>
                            
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection