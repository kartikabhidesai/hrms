@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<!--    <div class="row">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right"></span>
                    <h5>New</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $arrNewCount }}</h1>
                    <div class="stat-percent font-bold text-success"></div>
                    <small></small>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Inprogress</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $arrInprogressCount }}</h1>
                    <div class="stat-percent font-bold text-info"></div>
                    <small></small>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right"></span>
                    <h5>Completed</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $arrCompletedCount }}</h1>
                    <div class="stat-percent font-bold text-success"></div>
                    <small></small>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-tools">
                    <a href="{{url('employee/add-ticket')}}"><button class="btn btn-info pull-left" value="approve" type="button">Add New Ticket</button></a>
                </div>
            </div>
        </div>

        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'filtter' )) }}

        <div class="col-lg-2">
            <div class="form-group">
                <label class="col-lg-2 control-label">Priority</label>
                <select name="department" id="priority" class="form-control priority">
                    <option value="">Select Priority</option>
                    <option value="HIGH" {{ ( @$priority == 'HIGH' ? 'selected="selected"' : '') }}>High</option>
                    <option value="NORMAL" {{ ( @$priority == 'NORMAL' ? 'selected="selected"' : '') }}>Normal</option>
                    <option value="LOW" {{ ( @$priority == 'LOW' ? 'selected="selected"' : '') }}>Low</option>
                </select>
            </div>
            <div class="form-group hide">
                <label class="col-lg-2 control-label">Status</label>
                <select name="department" id="status" class="form-control status">
                    <option value="">Select Status</option>
                    <option value="0" {{ ( @$status == '0' ? 'selected="selected"' : '') }}>In Progess</option>
                    <option value="1" {{ ( @$status == '1' ? 'selected="selected"' : '') }}>Pending</option>
                    <option value="2" {{ ( @$status == '2' ? 'selected="selected"' : '') }}>Complete</option>
                </select>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-tools">
                    <button class="btn btn-sm btn-primary filler pull-left" value="approve" type="button">Apply filter</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>-->

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

	<div class="row">
		<div class="col-lg-12">
			{{ csrf_field() }}
			<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets List</h5>
                        <div class="ibox-tools">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="TicketDatatables">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Subject</th>
<!--                                         <th>Assign to</th> -->
                                        <th>Created by</th>
                                        <th>Details</th>
                                        <th>Attachment</th>
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

    <div id="ticketDetailsModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Ticket Details</h3>
                            <br/>
                            <!-- <b>Employee Name: </b><span class="m-t-none m-b empName"></span><br/> -->
                            <div class="codeDiv">
                                <b>Code : </b><span class="m-t-none m-b code"></span><br/>
                            </div>
                            <div class="subjectDiv">
                                <b>Subject : </b><span class="m-t-none m-b subject"></span><br/>
                            </div>
                            <div class="priorityDiv">
                                <b>Priority: </b><span class="m-t-none m-b priorityDetail"></span><br/>
                            </div>
                            <div class="statusDiv">
                                <b>Status: </b><span class="m-t-none m-b status"></span><br/>
                            </div>
                            <div class="assignedToDiv">
                                <b>Assigned To: </b><span class="m-t-none m-b assignedTo"></span><br/>
                            </div>
                            <div class="detailsDiv">
                                <b>Details : </b><span class="m-t-none m-b details"></span><br/>
                            </div>
                            <div class="createdByDiv">
                                <b>Created By : </b><span class="m-t-none m-b createdBy"></span><br/>
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

    <div id="ticketEditModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Update Ticket Details</h3></div>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <!-- <div class="ibox-title">
                                    <h5>Update Ticket Details</h5>
                                </div> -->
                                <div class="ibox-content">
                                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'ticket-add' )) }}
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Ticket Code</label>
                                            <div class="col-lg-10">
                                                    {{ Form::text('ticket_code', null, array('id'=>'ticket_code', 'placeholder'=>'Ticket Code', 'class' => 'form-control ticket_code' ,'required')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Subject</label>
                                            <div class="col-lg-10">
                                                    {{ Form::text('subject', null, array('id'=>'subject','placeholder'=>'Subject', 'class' => 'form-control subject' ,'required')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Priority</label>
                                            <div class="col-lg-10">
                                                <select name="priority" id="priority" class="form-control priority" required="required">
                                                    <option value="">select</option>
                                                    <option value="High">High</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Low">Low</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Details</label>
                                            <div class="col-lg-10">
                                                {{ Form::textarea('details', null, array('id'=>'details', 'placeholder'=>'Details', 'class' => 'form-control' ,'required')) }}
                                            </div>
                                        </div>

                                        <div class="add_designation_div">
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <input class="btn btn-sm add_designation" type="button" value="Add More Attachment">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-sm btn-primary" type="submit">Update Ticket</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
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
    </div>


    <div id="updateTicketStatusModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Ticket Status Details</h4>
            </div>
            {{ Form::open( array('method' => 'post','files' => true, 'class' => 'form-horizontal', 'id' => 'updateTicketStatus' )) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                         <input type="hidden" class="form-control ticket_id" name="ticket_id" id="ticket_id">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Complete Progress</label>
                            <div class="col-sm-9">
                                {{ Form::select('complete_progress', $task_progress , null, array('class' => 'form-control m-b c-select complete_progress', 'id' => 'complete_progress')) }}
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ticket Status</label>
                            <div class="col-sm-9">
                                {{ Form::select('status', $status , null, array('class' => 'form-control m-b c-select status', 'id' => 'status')) }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form role="form">
                    <button class="btn btn-sm btn-default pull-right m-l " data-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-primary pull-right updatetask m-l" type="submit">Update</button>
                </form>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

    @endsection
