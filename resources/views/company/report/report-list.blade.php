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
                                    <td>Manage Task Report </td>
                                    <td><a href="{{ route('task-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Manage Ticket Report </td>
                                    <td><a href="{{ route('ticket-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Client Report </td>
                                    <td><a href="{{ route('client-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Manage Transaction Report </td>
                                    <td><a href="{{ route('transaction-report') }}" >View</a></td>
                                </tr>
                                <tr>
                                    <td>Manage Hoilday Report </td>
                                    <td><a href="{{ route('holiday-report') }}" >View</a></td>
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
