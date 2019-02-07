@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Time Change Request List</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('new-time-change-request') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> New Reqeust</i></a>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="requestlist">
                            <thead>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Department Name</th>
                                    <th>Submit Date</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Request Type</th>
                                    <th>Total Hours</th>
                                    <th>Request Description</th>
                                    <th>Status</th>
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
@endsection
