@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    
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
                        <h5>Tickets Comments</h5>
                        <div class="ibox-tools">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                Code : {{$ticket_details['code']}}
                            </div>
                            <div class="col-lg-6">
                                Subject : {{$ticket_details['subject']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                Status : {{$ticket_details['status']}}
                            </div>
                            <div class="col-lg-6">
                                Priority : {{$ticket_details['priority']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                Assign To : {{$ticket_details['assign_to']}}
                            </div>
                            <div class="col-lg-6">
                                Details : {{$ticket_details['details']}}
                            </div>
                        </div>
                   

                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Comments:</h2>
                                    @foreach($ticket_comment as $row)
                                    <div class="social-feed-box">
                                        <div class="social-avatar">
                                            <a href="" class="pull-left">
                                                @if(!empty($row['photo']))
                                                <img alt="image" src="{{ asset('uploads/client/'.$row['photo']) }}">
                                                @else
                                                <img alt="image" src="{{ asset('img/profile_small.jpg') }}">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <a href="#">
                                                    {{$row['name']}}
                                                </a>
                                                <small class="text-muted">{{ date('d-m-Y h:i a', strtotime($row['created_at'])) }}</small>
                                            </div>
                                        </div>
                                        <div class="social-body">
                                            <p>
                                                {{ $row['comments'] }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addTicketComment' )) }}
                                <input type="hidden" class="form-control" required="" name="ticket_id" value="{{$ticket_details['id']}}">
                                
                                <div class="col-lg-12">
                                    <textarea class="form-control" required="" name="comments"  placeholder="Comments"></textarea>
                                <div>
                                
                                <div class="col-lg-offset-11 col-lg-1" style="padding-top:5px">
                                    <button class="btn btn-sm btn-primary" type="submit">Send</button>
                                </div>
                            
                                {{ Form::close() }}
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
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Update Ticket Details</h3>
                            <br/>
                            <!-- <b>Employee Name: </b><span class="m-t-none m-b empName"></span><br/> -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Ticket Code</label>
                                <div class="col-lg-8">
                                        {{ Form::text('ticket_code', null, array('placeholder'=>'Ticket Code', 'class' => 'form-control ticket_code' ,'required')) }}
                                </div>
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


    <!-- <div id="approveModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                            <b>Are You sure want to approve time change request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesapprove m-l" type="button"><strong><i class="fa fa-trash"></i> Approve </strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="disapproveModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                            <b>Are You sure want to reject time change request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesreject m-l" type="button"><strong><i class="fa fa-trash"></i> Reject </strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->

    @endsection
