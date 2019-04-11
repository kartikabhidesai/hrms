

@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'editLeaveCategoryType' )) }}
        <input type="text" name="editId" class="hidden" value="{{ $leaveDetails[0]['id']}}">
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
                            <input type="text" class="form-control" name="leave_cat_name" placeholder="Enter Name" value="{{ $leaveDetails[0]['leave_cat_name'] }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Type:</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="type" class="fulltime" value="Paid" {{ (($leaveDetails[0]['type'] == "Paid"))? ' checked="checked"' : '' }}>Paid
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" class="fulltime" value="Unpaid" {{ (($leaveDetails[0]['type'] == "Unpaid"))? ' checked="checked"' : '' }}>Unpaid
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" class="fulltime" value="OnDuty" {{ (($leaveDetails[0]['type'] == "OnDuty"))? ' checked="checked"' : '' }}>OnDuty
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" class="fulltime" value="Restricted Holiday" {{ (($leaveDetails[0]['type'] == "Restricted Holiday"))? ' checked="checked"' : '' }}>Restricted Holiday
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Leave Unit:</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="leave_unit" class="fulltime" value="Days" {{ (($leaveDetails[0]['leave_unit'] == "Days"))? ' checked="checked"' : '' }}>Days
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="leave_unit" class="fulltime" value="Hours" {{ (($leaveDetails[0]['leave_unit'] == "Hours"))? ' checked="checked"' : '' }}>Hours
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Description:</label>
                        <div class="col-lg-10">
                            <textarea cols="15" rows="5" class="form-control" name="description" placeholder="Enter Description">{{ $leaveDetails[0]['description'] }}</textarea>
                        </div>
                    </div>

                    <br><h4>Applicalbe For:</h4>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">For:</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="applicable_for" class="fulltime" value="Role/Location" {{ (($leaveDetails[0]['applicable_for'] == "Role/Location"))? ' checked="checked"' : '' }}>Role/Location
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="applicable_for" class="fulltime" value="Employee" {{ (($leaveDetails[0]['applicable_for'] == "Employee"))? ' checked="checked"' : '' }}>Employee
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Role:</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="role" id="role">
                                <option value="">Selelect Role</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="#addRoleModel" class="btn btn-sm btn-primary" data-toggle="modal" title="Add" data-original-title="Add" ><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Work Location:</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="work_location" id="work_location">
                                <option value="">Select Location</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="#addWorkLocationModel" class="btn btn-sm btn-primary" data-toggle="modal" title="Add" data-original-title="Add" ><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gender:</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="gender" class="fulltime" value="Male" {{ (($leaveDetails[0]['gender'] == "Male"))? ' checked="checked"' : '' }}>Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" class="fulltime" value="Female" {{ (($leaveDetails[0]['gender'] == "Female"))? ' checked="checked"' : '' }}>Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Marital Status:</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" class="fulltime" value="Single" {{ (($leaveDetails[0]['marital_status'] == "Single"))? ' checked="checked"' : '' }}>Single
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" class="fulltime" value="Married" {{ (($leaveDetails[0]['marital_status'] == "Married"))? ' checked="checked"' : '' }}>Married
                            </label>
                        </div>
                    </div>

                    <br><h4>Leave Entitlement:</h4>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Period:</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="period" id="period">
                                <option value="">Select Period</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="#addperiodModel" class="btn btn-sm btn-primary" data-toggle="modal" title="Add" data-original-title="Add" ><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">For :</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="for_employee_type" class="fulltime" value="all_emp" {{ (($leaveDetails[0]['for_employee_type'] == "all_emp"))? ' checked="checked"' : '' }} >All Employees
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="for_employee_type" class="fulltime" value="experience_base" {{ (($leaveDetails[0]['for_employee_type'] == "experience_base"))? ' checked="checked"' : '' }}>Experience Based
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Leave Count :</label>
                        <div class="col-lg-10">
                            <input type="number" name="leave_count" class="form-control" value="{{ $leaveDetails[0]['leave_count'] }}"> day(s)/year
                        </div>
                    </div>
                    <div class="form-group experience_lib" >
                        @for($i=0 ; $i < count($getcount) ; $i++)
                        <div class="col-lg-12 removediv"><div class="col-lg-2"></div>
                            <div class="col-lg-10 " style="padding-bottom: 15px;">
                                <div class="col-lg-3">
                                    <select class="form-control" name="expriances[]" id="period">
                                        <option value="">Select Employee type</option>
                                        <option value="For new joining" {{ (($getcount[$i]['employee_type'] == "all_emp"))? ' checked="checked"' : '' }}>For New joining</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="entitlement_name[]" placeholder="Enter Name" value="{{ $getcount[$i]['name']}}">
                                </div>
                                
                                <label class="col-lg-1 control-label">Y</label>
                                
                                <div class="col-lg-2">
                                    <input type="number" class="form-control" name="year[]" placeholder="Enter year" value="{{ $getcount[$i]['year']}}">
                                </div>
                                
                                <label class="col-lg-1 control-label">M</label>
                                
                                <div class="col-lg-2">
                                    <input type="number" class="form-control" name="month[]" placeholder="Enter month" value="{{ $getcount[$i]['month']}}">
                                </div>
                                @if($i == 0)
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-sm btn-primary addnewHTML"><i class="fa fa-plus"></i></button>
                                    </div>
                                @else
                                    <div class="col-lg-1">
                                        <button type="button" class="red btn-sm btn-primary removebtn"><i class="fa fa-trash"></i></button>
                                    </div>
                                @endif
                                
                            </div></div>
                    
                    @endfor
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <div class="col-lg-offset-5 col-lg-6">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div id="addRoleModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Role</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="addRole" class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label class="col-sm-4 control-label">Role Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role Name">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default pull-right m-l " data-dismiss="modal">Close</button>
                <a class="btn btn-sm btn-primary pull-right addRole m-l" >Add</a>
            </div>
        </div>
    </div>
</div>
<div id="addWorkLocationModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Work Location </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="addWork" class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label class="col-sm-4 control-label">Work Location:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="work_location_name" id="work_location_name" placeholder="Work Location Name">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default pull-right m-l " data-dismiss="modal">Close</button>
                <a class="btn btn-sm btn-primary pull-right addWork_location m-l" >Add</a>
            </div>
        </div>
    </div>
</div>
<div id="addperiodModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Period </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="addPeriod" class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <label class="col-sm-4 control-label">Period:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="new_period" id="new_period" placeholder="Add new period">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default pull-right m-l " data-dismiss="modal">Close</button>
                <a class="btn btn-sm btn-primary pull-right addPeriod m-l" >Add</a>
            </div>
        </div>
    </div>
</div>
@endsection