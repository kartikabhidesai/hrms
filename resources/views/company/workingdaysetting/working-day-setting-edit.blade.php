@extends('layouts.app')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'paySlip' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <h5>Working Day Setting</h5>
               </div>
               <div class="ibox-content">      
               <h5 >Time Zone</h5>   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="time1" name="time1">
                                <option value="">System Default</option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Name:</label>
                        <div class="col-sm-4">
                        <select class="form-control" id="time2" name="time2">
                                <option value="">(GMT+10:00) Sydney</option>
                                <option value="">(GMT+05:30) Kalkata</option>
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
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Monday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">                            
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">     Tuesday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>                            
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Wednesday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Thursday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Friday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Saturday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><input style="float: left;margin-left: 30px;" type="checkbox" class="checkAll" id="checkAll" name="checkAll">  Sunday:</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">Full Day</option>
                                    <option value="">Half Day</option>
                                    <option value="">Non Working Day</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Working For</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                            <label class="col-sm-1 align-center">To</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="time2" name="time2">
                                    <option value="">02:00</option>
                                    <option value="">12:00</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <h5 ><b>Non Working Day</b></h5> 
                    <label class="control-label">Dates</label>
                    <table><tr><td>No dates</td></tr></table>
                    <br/>
                    <button class="btn btn-primary" value="submit" name="">Add Date</button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection
