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
                                    <input type="radio" name="type" class="fulltime" checked>Paid
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime">Unpaid
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime">OnDuty
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" class="fulltime">Restricted Holiday
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Leave Unit:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="leave_unit" class="fulltime" checked>Days
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="leave_unit" class="fulltime">Hours
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
                                    <input type="radio" name="applicalbe_for" class="fulltime" checked>Role/Location
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="applicalbe_for" class="fulltime">Employee
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Role:</label>
							<div class="col-lg-10">
                                <select class="form-control">
                                	<option>Select Option</option>
                                	<option>All roles</option>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Work Location:</label>
							<div class="col-lg-10">
                                <select class="form-control">
                                	<option>Select Option</option>
                                	<option>All locations</option>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Gender:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" class="fulltime" checked>Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" class="fulltime">Female
                                </label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Marital Status:</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" class="fulltime" checked>Single
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" class="fulltime">Married
                                </label>
							</div>
						</div>

						<br><h4>Leave Entitlement:</h4>
						<div class="form-group">
							<label class="col-lg-2 control-label">Period:</label>
							<div class="col-lg-10">
                                <select class="form-control">
                                	<option>Select Option</option>
                                	<option>Annual</option>
                                	<option>Monthly</option>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">For :</label>
							<div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="for_employee_type" class="fulltime" checked>All Employees
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="for_employee_type" class="fulltime">Experience Based
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