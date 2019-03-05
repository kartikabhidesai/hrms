@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add Ticket</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'ticket-add' )) }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Ticket Code</label>
                            <div class="col-lg-10">
                                    {{ Form::text('ticket_code', null, array('placeholder'=>'Ticket Code', 'class' => 'form-control ticket_code' ,'required')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Subject</label>
                            <div class="col-lg-10">
                                    {{ Form::text('subject', null, array('placeholder'=>'Subject', 'class' => 'form-control subject' ,'required')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Priority</label>
                            <div class="col-lg-10">
                                    <select name="priority" class="form-control priority" id="priority">
                                		<option>select</option>
                                		<option>High</option>
                                		<option>Normal</option>
                                		<option>Low</option>
                                	</select>
                            </div>
                        </div>
	                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Assign to</label>
                            <div class="col-lg-10">
                                    <select name="assign_to" class="form-control assign_to" id="assign_to">
                                    	<option value="">Select</option>
                                    	@if(!empty($employee_list))
                                    		@foreach($employee_list as $el)
                                    			<option value="{{$el->id}}">{{$el->name}}</option>
                                    		@endforeach
                                    	@endif
                                	</select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Details</label>
                            <div class="col-lg-10">
                              	{{ Form::textarea('phone', null, array('placeholder'=>'Details', 'class' => 'form-control' ,'required')) }}
                            </div>
                        </div>

                        <div class="add_designation_div">
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <input class="btn btn-sm add_designation" type="button" value="Add More Attachment">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">Save Ticket</button>
                            </div>
                        </div>
	               {{ Form::close() }}
                </div>
            </div>
        </div>  
        
	</div>
</div>

@endsection