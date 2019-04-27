@extends('layouts.app')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
	   <div class="row">
            <div class="col-lg-12">
			{{ csrf_field() }}
			    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Add Social Media post</h5>
                    </div>
                    <div class="ibox-content">
                       {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'socialMedia' , 'enctype'=>'multipart/form-data' )) }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Post to</label>
                                <div class="col-sm-9">
                                    @if(!empty($post_to_data))
                                        @foreach($post_to_data as $pf)
                                            <div class="col-lg-3">
                                                <label class="checkbox-inline"> 
                                                    <input type="checkbox" class="post_to" name="post_to[]" value="{{$pf}}" required>
                                                    Test Data
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Add Photos / Video</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control file_upload"  id="file_upload" name="file_upload[]" multiple=""> 
                                </div>
                            </div>-
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control message" id="message" name="message" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Delivery option</label>
                                <div class="col-sm-2"> 
                                    <input type="radio" class="delivery_option" name="delivery_option" value="post_now" required> Post Now<br>
                                    <input type="radio" class="delivery_option" name="delivery_option" value="post_later" required> Post Later<br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">Date</label>
                                    <div class="input-group" id="datetimepicker">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control delivery_date" id="delivery_date" name="delivery_date" type="text" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">Time</label>
                                    <div class="input-group" id="datetimepicker">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="delivery_time" class="form-control delivery_time" data-time-format="H:i:s" type="text" name="delivery_time" autocomplete="off" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary sendSMS" type="submit">Send</button>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
