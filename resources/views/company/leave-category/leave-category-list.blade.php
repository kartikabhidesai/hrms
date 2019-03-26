@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Award List</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('leave-category-add') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="LeaveCategoryDatatables">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Maximum Leave</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> Absent</td>
                                    <td>Unpaid</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: orange;"></i> Annual Leaves</td>
                                    <td>Paid</td>
                                    <td>12</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: green;"></i> Compensatory Off</td>
                                    <td>Compensatory Off</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr><tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> DOJ based Leaves</td>
                                    <td>Paid</td>
                                    <td>1</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> Hourly Leaves</td>
                                    <td>Unpaid</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> Loss Of Pay</td>
                                    <td>Unpaid</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> Maternity Leave</td>
                                    <td>Unpaid</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-circle" style="color: red;"></i> On Duty</td>
                                    <td>Unpaid</td>
                                    <td>0</td>
                                    <td><i class="fa fa-check-square"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
