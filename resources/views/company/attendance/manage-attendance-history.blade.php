@extends('layouts.app')
@section('content')
    <!-- <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            {{ csrf_field() }}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Attendance History</h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'attendanceHistory' )) }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">From Date:</label>
                            <div class="col-sm-9">
                                <div class="input-group from_date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="from_date" value="" id="from_date" placeholder="From Date" class="form-control from_date dateField" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">To Date:</label>
                            <div class="col-sm-9">
                                <div class="input-group to_date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="to_date" value="" id="to_date" placeholder="To Date" class="form-control to_date dateField" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Employees By Department </label>
                            <div class="col-sm-9">
                                <select class="form-control department_id" name="department_id">
                                    <option value="" selected="">Select Employees Of A Department</option>
                                    <option value="IT" selected="">IT Department</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary getAttedanceReport" type="submit">Manage</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="requestlist">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department Name</th>
                            <th>Type Of Leave</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2019/01/20</td>
                            <td>Employee 1</td>
                            <td>IT</td>
                            <td>Vacation</td>
                            <td><a href="#">Review</a></td>
                        </tr>
                        <tr>
                            <td>2019/01/20</td>
                            <td>Employee 2</td>
                            <td>IT</td>
                            <td>Vacation</td>
                            <td><a href="#">Review</a></td>
                        </tr>
                        <tr>
                            <td>2019/01/20</td>
                            <td>Employee 3</td>
                            <td>IT</td>
                            <td>Vacation</td>
                            <td><a href="#">Review</a></td>
                        </tr>
                        <tr>
                            <td>2019/01/20</td>
                            <td>Employee 4</td>
                            <td>IT</td>
                            <td>Vacation</td>
                            <td><a href="#">Review</a></td>
                        </tr>
                        <tr>
                            <td>2019/01/20</td>
                            <td>Employee 5</td>
                            <td>IT</td>
                            <td>Vacation</td>
                            <td><a href="#">Review</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Manage Attendance History</h5>
                        <div class="ibox-tools">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="attendanceHistoryList">
                                <thead>
                                    <tr>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Name Of Employee</th>
                                        <th>Department Name</th>
                                        <th>Type Of Leave</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="historyDetailsModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Details</h3>
                            <b>Some texts here...</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
