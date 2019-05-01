@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Report</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" >
                            <thead>
                                <tr>
                                    <th>Report Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Company Report</td>
                                    <td><a href="{{ route('company-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Finance Report </td>
                                    <td><a href="{{ route('finance-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>manage Order Report </td>
                                    <td><a href="{{ route('order-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Plan and Packaging report </td>
                                    <td><a href="{{ route('plan-package-report') }}" >View</a></td>
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
