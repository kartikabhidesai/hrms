@extends('layouts.app')
@section('content')
<style type="text/css">
    div#requestlist_filter {
        margin-right: -442px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Calendar</h5>
                            <div class="ibox-tools">
                                <a href="#addNewEventModel" data-toggle="modal" class="btn btn-primary dim" ><i class="fa fa-plus"> Add Event </i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addNewEventModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="POST" class="form-horizontal" id="addNewEvent">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Title:</label>
                                <input type="text" class="form-control title" name="title" id="title" placeholder="Title" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="form-control-label">Notes:</label>
                                <textarea class="form-control notes" id="notes" placeholder="Notes"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="form-control-label">Date:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="event_date" id="" placeholder="Select Date Event" class="form-control event_date" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="message-text" class="form-control-label">Time:</label>
                                <div class="input-group" id="datetimepicker">
                                    <input id="event_time" class="form-control event_time" data-time-format="H:i:s" type="text" name="event_time" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary m-l newEventModel" type="submit">Submit</button>
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
