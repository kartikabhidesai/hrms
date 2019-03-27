@extends('layouts.app')
@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addLeaveCategoryType' )) }}

			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Leave Type</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
						</div>
					</div>

					<div class="ibox-content">
						<div class="form-group">
							<label class="col-lg-2 control-label">Name:</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="leave_cat_name" placeholder="Enter Name">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Type:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime" value="Paid" checked>Paid
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime" value="Unpaid">Unpaid
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime" value="OnDuty">OnDuty
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime" value="Restricted Holiday">Restricted Holiday
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Leave Unit:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="leave_unit" class="fulltime" value="Days" checked>Days
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="leave_unit" class="fulltime" value="Hours">Hours
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Description:</label>
							<div class="col-lg-10">
                                <textarea cols="15" rows="5" class="form-control" name="description" placeholder="Enter Description"></textarea>
                            </div>
						</div>

						<br><h4>Applicalbe For:</h4>
						<div class="form-group">
							<label class="col-lg-2 control-label">For:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="applicable_for" class="fulltime" value="Role/Location" checked>Role/Location
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="applicable_for" class="fulltime" value="Employee">Employee
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Role:</label>
							<div class="col-lg-10">
                                <select class="form-control" name="role" id="role">
                                	<option value="">Select Option</option>
                                	@if(!empty($leave_category_role))
	                                	@foreach($leave_category_role as $key => $val)
	                                		<option value="{{$key}}">{{$val}}</option>
	                                	@endforeach
	                                @endif
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Work Location:</label>
							<div class="col-lg-10">
                                <select class="form-control" name="work_location" id="work_location">
                                	<option>Select Option</option>
                                	@if(!empty($leave_work_location))
	                                	@foreach($leave_work_location as $key => $val)
	                                		<option value="{{$key}}">{{$val}}</option>
	                                	@endforeach
	                                @endif
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Gender:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" class="fulltime" value="Male" checked>Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" class="fulltime" value="Female">Female
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Marital Status:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" class="fulltime" value="Single" checked>Single
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" class="fulltime" value="Married">Married
                                </label>
							</div>
						</div>

						<br><h4>Leave Entitlement:</h4>
						<div class="form-group">
							<label class="col-lg-2 control-label">Period:</label>
							<div class="col-lg-10">
                                <select class="form-control" name="period" id="period">
                                	<option>Select Option</option>
                                	<option value="Annual">Annual</option>
                                	<option value="Monthly">Monthly</option>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">For :</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="for_employee_type" class="fulltime" value="All Employees" checked>All Employees
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="for_employee_type" class="fulltime" value="Experience Based">Experience Based
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Leave Count :</label>
							<div class="col-lg-10">
                                <input type="number" name="leave_count" class="form-control"> day(s)/year
							</div>
						</div>

						<div class="form-group">
                            <div class="col-lg-offset-5 col-lg-6">
                                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection