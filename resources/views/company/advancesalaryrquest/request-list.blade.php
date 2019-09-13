@extends('layouts.app')
@section('content')
<style type="text/css">
    div#requestlist_filter {
        margin-right: -442px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $requestType }}</h5>
                     <div class="ibox-tools">
                            <a href="{{ route('add-advance-salary-request') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                        </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <div class="ibox-tools col-sm-12">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-info pull-left changeStatus" style="margin:0px 5px" value="approve" type="button">Approved </button>
                                <button class="btn btn-danger pull-left changeStatus" style="margin:0px 5px" value="reject" type="button"> Deny </button>
                                <button class="btn btn-default pull-left all"  style="margin:0px 5px" type="button"> All Request : {{ $allRequestCount }}</button>
                                <button class="btn btn-primary pull-left newRequest" style="margin:0px 5px" type="button"> New Request : {{ $allNewRequestCount }}</button>
                                <button class="btn btn-success pull-left aprroved"  style="margin:0px 5px" type="button"> Approved Request : {{ $allApprovedRequestCount }}</button>
                                <button class="btn btn-warning pull-left rejected"  style="margin:0px 5px" type="button"> Rejected Request : {{ $allRejectedRequestCount }}</button>
                            </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="requestlist">
                            <thead>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkAl" id="checkAl" name="checkAl"></td>
                                    <th>Name</th>
                                    <th>Department Name</th>
                                    <th>Submit Date</th>
                                    <th>Comments</th>
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


 <div id="approveModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Approve Request</h3>
                            <b>Are You sure want to approve advance salary request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesapprove m-l" type="button"><strong></strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="disapproveModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                            <b>Are You sure want to reject advance salary request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesreject m-l" type="button"><strong><i class="fa fa-trash"></i> Reject </strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
