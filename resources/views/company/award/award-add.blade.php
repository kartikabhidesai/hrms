@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Award</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addAward' )) }}
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Employee</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="employee" name="employee" required="required">
                                <option value="">Select</option>
                                @foreach($getAllEmpOfCompany as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                        <label class="col-lg-1 control-label">Department</label>
                        <div class="col-lg-4">
                            <select class="form-control" id="department" name="department" required="required">
                                <option value="">Select</option>
                                @foreach($getDepartmentOfCompany as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label">Award</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="number" name="award" id="award" placeholder="Award" class="form-control award" required="required">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                        <label class="col-sm-1 control-label">Date</label>
                        <div class="col-lg-4">
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date" id="date_award"  class="form-control date" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">Comment</label>
                        <div class="col-lg-5">
                            {{ Form::textarea('comment', null, array('placeholder'=>'comment', 'rows' => 4,'class' => 'form-control' ,'required')) }}
                        </div>
                        <div class="col-lg-1">
                            <a data-toggle="tooltip" class="tooltipLink" data-original-title="Tooltip text goes here">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </a>
                        </div>
                        <label class="col-lg-1 control-label">Upload File</label>
                        <div class="col-lg-4">
                            <div class="input-group ">
                                <input type="file" name="file_attachment" id="file_attachment" class="form-control file_attachment">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-11">
                                <button class="btn btn-sm btn-primary" type="submit">Add Award</button>
                                <!-- <button type="button" class="btn btn-sm btn-info">Reset</button> -->
                                <!-- <button type="button" class="btn btn-sm btn-danger">Cancel</button> -->
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>  

    </div>
</div>

@endsection