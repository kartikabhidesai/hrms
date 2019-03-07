@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
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
                    <a href="{{url('company/add-ticket')}}"><button class="btn btn-info pull-left" value="approve" type="button">Add New Ticket</button></a>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-tools">
                    <button class="btn btn-info pull-left changeStatus" value="approve" type="button">Filter</button>
                </div>
            </div>
        </div>
    </div>

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
                                        <th>Assign to</th>
                                        <th>Created by</th>
                                        <th>Details</th>
                                        <th>Attachment</th>
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
