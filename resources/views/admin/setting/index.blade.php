@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Web-site Setting</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'setting' )) }}
                    <div class="form-group"><label class="col-lg-2 control-label">Site Title</label>
                        <div class="col-lg-9">
                            {{ Form::text('site_title', $setting[0]['site_title'], array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Site Tag-line</label>
                        <div class="col-lg-9">
                            {{ Form::text('site_tagline', $setting[0]['site_tagline'], array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            {{ Form::text('email', $setting[0]['email'], array('class' => 'form-control' ,'required')) }}
                            <span class="help-block m-b-none">This email address is used for admin purpose if you change this we will send you an email at your new email address to confirm it.The new email address will not become active until confirmed .</span>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Time-zone</label>
                        <div class="col-lg-9">
                            {{ Form::text('timezone', $setting[0]['timezone'], array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Date Formate</label>
                        <div class="col-sm-9">
                            <div><label> <input type="radio" checked="" value="1" id="optionsRadios1" name="dateformate">  January 30,2018 </label></div>
                            <div><label> <input type="radio" value="2" id="optionsRadios2" name="dateformate"> 30/01/2018</label></div>
                            <div><label> <input type="radio" value="3" id="optionsRadios2" name="dateformate"> 01/30/2018</label></div>
                            <div><label> <input type="radio" value="4" id="optionsRadios2" name="dateformate"> Custom  &nbsp;&nbsp;&nbsp;<input  type="text" name="customedate"> &nbsp;&nbsp;&nbsp;January 30,2018</label></div>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Time Formate</label>
                        <div class="col-sm-9">
                            <div><label> <input type="radio" checked="" value="1" id="" name="timeformate">  18:30 </label></div>
                            <div><label> <input type="radio" value="2" id="" name="timeformate">  06:30 PM</label></div>
                            <div><label> <input type="radio" value="3" id="" nam7e="timeformate"> Custom &nbsp;&nbsp;&nbsp;<input  type="text" name="custometime"> &nbsp;&nbsp;&nbsp;18:30</label></div>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Week Start</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="startweek" >
                                 <option value="">Select start of week</option>
                                <option value="monday">Monday</option>
                                <option value="tuseday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Language</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="language" >
                                <option value="">Select Language</option>
                                <option value="english">English</option>
                                <option value="trukish">Trukish</option>
                                <option value="german">German</option>
                            </select>
                        </div>
                    </div>
                    
                     <div class="form-group"><label class="col-lg-2 control-label">Site Address (URL)</label>
                        <div class="col-lg-9">
                            {{ Form::text('site_address', $setting[0]['siteurl'], array('class' => 'form-control' ,'required')) }}
                            
                        </div>
                    </div>
                    	
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>	
    </div>
</div>
@endsection