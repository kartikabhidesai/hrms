@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
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
                                        <option value="0" {{ ( $status == '0' ? 'selected="selected"' : '') }}>In Progess</option>
                                        <option value="1" {{ ( $status == '1' ? 'selected="selected"' : '') }}>Pending</option>
                                        <option value="2" {{ ( $status == '2' ? 'selected="selected"' : '') }}>Complete</option>
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
                                    <th>Emoloyee File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>Design</td>
                                    <td>ABC</td>
                                    <td>High</td>
                                    <td>Pending</td>
                                    <td>50%</td>
                                    <td>Abcdef Abcdef Abcdef</td>
                                    <td>
                                        <a href="" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                                
                                <tr>
                                    <td>2</td>
                                    <td>API</td>
                                    <td>ABC</td>
                                    <td>Normal</td>
                                    <td>Pending</td>
                                    <td>70%</td>
                                    <td>AbcdefAbcdefAbcdef Abcdef Abcdef</td>
                                    <td>
                                        <a href="" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr> -->
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