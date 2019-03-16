@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Annoucement</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addAnnouncement' )) }}
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Title</label>
                        <div class="col-lg-5">
                            {{ Form::text('title', null, array('placeholder'=>'Title', 'class' => 'form-control' ,'required')) }}
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-9">
                                    <div class="input-group ">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" id="start_date"  class="form-control start_date" placeholder="Start date" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label">Status</label>
                        <div class="col-lg-5">
                            {{ Form::select('status', $status , null, array('placeholder'=>'Select status', 'class' => 'form-control status', 'id' => 'status')) }}
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group" id="data_2">
                                <label class="col-sm-2 control-label">Time</label>
                                <div class="col-sm-9">
                                    
                                    <div class="input-group" id="datetimepicker">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input id="time" class="form-control time" data-time-format="H:i:s" type="text" name="time" />
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Content</label>
                        <div class="col-lg-5">
                            {{ Form::textarea('content', null, array('placeholder'=>'Content', 'rows' => 4,'class' => 'form-control' ,'required')) }}
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="col-lg-8 col-lg-offset-2">
                                <button class="btn btn-sm btn-primary" type="submit">Add Annoucement</button>
                                <button type="button" class="btn btn-sm btn-info">Reset</button>
                                <button type="button" class="btn btn-sm btn-danger">Cancel</button>
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