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
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollDatatables">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Scheduled Hours Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01/01/2019</td>
                                    <td>Overtime hours</td>
                                    <td>Approved</td>
                                    <td> 
                                        <a href="" class="link-black text-sm" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash"></i></a>
                                    </td>
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
