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
                            <input type="text" class="form-control" name="site_title" value="{{ isset($setting[0]['site_title']) ? $setting[0]['site_title'] : "" }}">
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Site Tag-line</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="site_tagline" value="{{ isset($setting[0]['site_tagline']) ? $setting[0]['site_tagline'] : "" }}">
                        </div>
                    </div>
                    
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="email" value="{{ isset($setting[0]['email']) ? $setting[0]['email'] : "" }}">
                            
                            <span class="help-block m-b-none">This email address is used for admin purpose if you change this we will send you an email at your new email address to confirm it.The new email address will not become active until confirmed .</span>
                        </div>
                    </div>
                    
                     
                    <div class="form-group"><label class="col-lg-2 control-label">Time-zone</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="timezone" value="{{ isset($setting[0]['timezone']) ? $setting[0]['timezone'] : "" }}">
                        </div>
                    </div>
                    
                    @if(isset($setting[0]['dateformate']))
                        <div class="form-group"><label class="col-lg-2 control-label">Date Formate</label>
                            <div class="col-sm-9">
                                <div><label> <input type="radio" value="1" {{ ($setting[0]['dateformate'] == '1' ? 'checked="checked"' : '') }} id="optionsRadios1" name="dateformate">  January 30,2018 </label></div>
                                <div><label> <input type="radio" value="2" {{ ($setting[0]['dateformate'] == '2' ? 'checked="checked"' : '') }} id="optionsRadios2" name="dateformate"> 30/01/2018</label></div>
                                <div><label> <input type="radio" value="3" {{ ($setting[0]['dateformate'] == '3' ? 'checked="checked"' : '') }} id="optionsRadios2" name="dateformate"> 01/30/2018</label></div>
                                <div><label> <input type="radio" value="4" {{ ($setting[0]['dateformate'] == '4' ? 'checked="checked"' : '') }} id="optionsRadios2" value="{{ $setting[0]['siteurl'] }}" name="dateformate"> Custom  &nbsp;&nbsp;&nbsp;<input  type="text" value="{{ $setting[0]['customdate'] }}" name="customdate"> &nbsp;&nbsp;&nbsp;January 30,2018</label></div>
                            </div>
                        </div>
                    @else
                        <div class="form-group"><label class="col-lg-2 control-label">Date Formate</label>
                            <div class="col-sm-9">
                                <div><label> <input type="radio" value="1"  id="optionsRadios1" name="dateformate">  January 30,2018 </label></div>
                                <div><label> <input type="radio" value="2"  id="optionsRadios2" name="dateformate"> 30/01/2018</label></div>
                                <div><label> <input type="radio" value="3"  id="optionsRadios2" name="dateformate"> 01/30/2018</label></div>
                                <div><label> <input type="radio" value="4"  id="optionsRadios2" value="" name="dateformate"> Custom  &nbsp;&nbsp;&nbsp;<input  type="text" value="" name="customdate"> &nbsp;&nbsp;&nbsp;January 30,2018</label></div>
                            </div>
                        </div>
                    
                    @endif
                    
                    
                    @if(isset($setting[0]['timeformate']))
                        <div class="form-group"><label class="col-lg-2 control-label">Time Formate</label>
                            <div class="col-sm-9">
                                <div><label> <input type="radio" {{ ($setting[0]['timeformate'] == '1' ? 'checked="checked"' : '') }} value="1" id="" name="timeformate">  18:30 </label></div>
                                <div><label> <input type="radio" {{ ($setting[0]['timeformate'] == '2' ? 'checked="checked"' : '') }}value="2" id="" name="timeformate">  06:30 PM</label></div>
                                <div><label> <input type="radio" value="3" {{ ($setting[0]['timeformate'] == '3' ? 'checked="checked"' : '') }}id="" name="timeformate"> Custom &nbsp;&nbsp;&nbsp;<input  type="text" value="{{ $setting[0]['customtime'] }}" name="custometime"> &nbsp;&nbsp;&nbsp;18:30</label></div>
                            </div>
                        </div>
                    @else
                        <div class="form-group"><label class="col-lg-2 control-label">Time Formate</label>
                        <div class="col-sm-9">
                            <div><label> <input type="radio"  value="1" id="" name="timeformate">  18:30 </label></div>
                            <div><label> <input type="radio" value="2" id="" name="timeformate">  06:30 PM</label></div>
                            <div><label> <input type="radio" value="3" id="" name="timeformate"> Custom &nbsp;&nbsp;&nbsp;<input  type="text" value="" name="custometime"> &nbsp;&nbsp;&nbsp;18:30</label></div>
                        </div>
                    </div>
                    
                    @endif
                    
                    
                    @if(isset($setting[0]['timeformate']))
                        <div class="form-group"><label class="col-lg-2 control-label">Week Start</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="startweek" >
                                    <option value="">Select start of week</option>
                                    <option value="monday" {{ ($setting[0]['weekstart'] == 'monday' ? 'selected="selected"' : '') }}>Monday</option>
                                    <option value="tuseday" {{ ($setting[0]['weekstart'] == 'tuseday' ? 'selected="selected"' : '') }}>Tuesday</option>
                                    <option value="wednesday"  {{ ($setting[0]['weekstart'] == 'wednesday' ? 'selected="selected"' : '') }}>Wednesday</option>
                                    <option value="thursday" {{ ($setting[0]['weekstart'] == 'thursday' ? 'selected="selected"' : '') }}>Thursday</option>
                                    <option value="friday" {{ ($setting[0]['weekstart'] == 'friday' ? 'selected="selected"' : '') }}>Friday</option>
                                    <option value="saturday" {{ ($setting[0]['weekstart'] == 'saturday' ? 'selected="selected"' : '') }}>Saturday</option>
                                    <option value="sunday" {{ ($setting[0]['weekstart'] == 'sunday' ? 'selected="selected"' : '') }}>Sunday</option>
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="form-group"><label class="col-lg-2 control-label">Week Start</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="startweek" >
                                    <option value="">Select start of week</option>
                                    <option value="monday" >Monday</option>
                                    <option value="tuseday" >Tuesday</option>
                                    <option value="wednesday"  >Wednesday</option>
                                    <option value="thursday" >Thursday</option>
                                    <option value="friday" >Friday</option>
                                    <option value="saturday" >Saturday</option>
                                    <option value="sunday" >Sunday</option>
                                </select>
                            </div>
                        </div>
                    
                    @endif
                    
                    
                    @if(isset($setting[0]['timeformate']))
                        <div class="form-group"><label class="col-lg-2 control-label">Language</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="language" >
                                    <option value="">Select Language</option>
                                    <option value="english" {{ ($setting[0]['language'] == 'english' ? 'selected="selected"' : '') }}>English</option>
                                    <option value="trukish" {{ ($setting[0]['language'] == 'trukish' ? 'selected="selected"' : '') }}>Trukish</option>
                                    <option value="german" {{ ($setting[0]['language'] == 'german' ? 'selected="selected"' : '') }}>German</option>
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="form-group"><label class="col-lg-2 control-label">Language</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="language" >
                                    <option value="">Select Language</option>
                                    <option value="english" >English</option>
                                    <option value="trukish" >Trukish</option>
                                    <option value="german" >German</option>
                                </select>
                            </div>
                        </div>
                    
                    @endif
                    	
                    <div class="form-group"><label class="col-lg-2 control-label">Site Address (URL)</label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control" name="site_address" value="{{ isset($setting[0]['siteurl']) ? $setting[0]['siteurl'] : "" }}">
                            
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary submitbtn" type="submit">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>	
    </div>
</div>
@endsection