@extends('layouts.app')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'workingDaySetting' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <h5>Working Day Setting</h5>
               </div>
               <input type="hidden" class="form-control day_time" id="workingdaysettingid" name="workingdaysettingid" value="{{ $workingdaysetting['id']}}" />
               <div class="ibox-content">      
               <h5 >Time Zone</h5>   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Region:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="region" name="region">
                                <option value="0">System Default</option>
                                <option value="1">Australia</option>
                                <option value="2">India</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Time Zone:</label>
                        <div class="col-sm-4">
                        <select class="form-control" id="time_zone" name="time_zone">
                                <option value="1">(GMT+10:00) Sydney</option>
                                <option value="2">(GMT+05:30) Kalkata</option>
                            </select>
                        </div>
                    </div> 
                    <hr>
                    
                    <h5><b>Standard Working Day</b></h5>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Every</label>
                            <div class="col-sm-4"></div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="monday_status" id="monday_status" name="monday_status" value="1" {{$workingdaysetting['monday_status']==1 ? 'checked' : ''}}>  Monday:</label>
                            <div class="col-sm-3">
                            {{ Form::select('monday_work', $day_works , !empty($workingdaysetting['monday_work'])?$workingdaysetting['monday_work']:null , array('class' => 'form-control monday_work', 'id' => 'monday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['monday_from']}}" id="monday_from" name="monday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                            <input type="text" class="form-control day_time" value="{{$workingdaysetting['monday_to']}}" id="monday_to" name="monday_to" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">                            
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="tuesday_status" id="tuesday_status" name="tuesday_status" value="1" {{$workingdaysetting['tuesday_status']==1 ? 'checked' : ''}} >     Tuesday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('tuesday_work', $day_works , !empty($workingdaysetting['tuesday_work'])?$workingdaysetting['tuesday_work']:null , array('class' => 'form-control tuesday_work', 'id' => 'tuesday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['tuesday_from']}}" id="tuesday_from" name="tuesday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['tuesday_to']}}" id="tuesday_to" name="tuesday_to" />
                            </div>                            
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="wednesday_status" id="wednesday_status" name="wednesday_status" value="1" {{$workingdaysetting['wednesday_status']==1 ? 'checked' : ''}} >  Wednesday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('wednesday_work', $day_works , !empty($workingdaysetting['wednesday_work'])?$workingdaysetting['wednesday_work']:null, array('class' => 'form-control wednesday_work', 'id' => 'wednesday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['wednesday_from']}}" id="wednesday_from" name="wednesday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['wednesday_to']}}" id="wednesday_to" name="wednesday_to" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="thursday_status" id="thursday_status" name="thursday_status" value="1" {{$workingdaysetting['thursday_status']==1 ? 'checked' : ''}}>  Thursday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('thursday_work', $day_works , !empty($workingdaysetting['thursday_work'])?$workingdaysetting['thursday_work']:null, array('class' => 'form-control thursday_work', 'id' => 'thursday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['thursday_from']}}" id="thursday_from" name="thursday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['thursday_to']}}" id="thursday_to" name="thursday_to" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="friday_status" id="friday_status" name="friday_status" value="1" {{$workingdaysetting['friday_status']==1 ? 'checked' : ''}} >  Friday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('friday_work', $day_works , !empty($workingdaysetting['friday_work'])?$workingdaysetting['friday_work']:null, array('class' => 'form-control friday_work', 'id' => 'friday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['friday_from']}}" id="friday_from" name="friday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['friday_to']}}" id="friday_to" name="friday_to" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="saturday_status" id="saturday_status" name="saturday_status" value="1" {{$workingdaysetting['saturday_status']==1 ? 'checked' : ''}}>  Saturday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('saturday_work', $day_works , !empty($workingdaysetting['saturday_work'])?$workingdaysetting['saturday_work']:null, array('class' => 'form-control saturday_work', 'id' => 'saturday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['saturday_from']}}" id="saturday_from" name="saturday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['saturday_to']}}" id="saturday_to" name="saturday_to" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="sunday_status" id="sunday_status" name="sunday_status" value="1" {{$workingdaysetting['sunday_status']==1 ? 'checked' : ''}}>  Sunday:</label>
                            <div class="col-sm-3">
                                {{ Form::select('sunday_work', $day_works , !empty($workingdaysetting['sunday_work'])?$workingdaysetting['sunday_work']:null, array('class' => 'form-control sunday_work', 'id' => 'sunday_work')) }}
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['sunday_from']}}" id="sunday_from" name="sunday_from" />
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2" id="datetimepicker">
                                <input type="text" class="form-control day_time" value="{{$workingdaysetting['sunday_to']}}" id="sunday_to" name="sunday_to" />
                            </div>
                        </div> 
                    </div>
                    <button class="btn btn-primary" value="submit">Save</button>
                    <hr>
                    <h5 ><b>Non Working Day</b></h5> 
                    <label class="control-label">Dates</label>
                    <!-- <table><tr><td>No dates</td></tr></table> -->
                    <div class="row" style="padding:15px">
                    @if(empty($nonworkingdate))
                        <div class="col-sm-12" style="background-color: lightblue;padding: 10px 0px 10px 10px;text-align:center">
                        No Dates
                        </div>
                    @else
                        @foreach($nonworkingdate as $rowDate)
                        <div class="col-sm-3" style="background-color: lightblue;padding: 10px 20px 10px 20px;margin:0px 5px;width:auto">
                        {{ date('d-m-Y', strtotime($rowDate['date'])) }}
                        </div>
                        @endforeach
                    @endif
                    </div>
                    <br/>
                    <!-- <button class="btn btn-primary" value="submit" name="">Add Date</button> -->
                    <a href="#addNonWorkingDate" class="btn btn-primary addNonWorkingDate" data-toggle="modal" title="Add Date" data-toggle="tooltip" data-original-title="Add Date">Add Date</a>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

<div id="addNonWorkingDate" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Non Working Date</h4>
            </div>
            <form action="" method="POST" class="form-horizontal" id="addNonWorkingDate">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date" id="date" placeholder="Date" class="form-control" value="" autocomplete="off">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary m-l newDateModel" type="submit">Submit</button>
                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                </div>
            
        </div>
    </div>
</div>

@endsection
