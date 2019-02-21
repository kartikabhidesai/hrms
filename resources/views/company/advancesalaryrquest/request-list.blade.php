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
                    <h5>Advance Salary Request List</h5>
                     <div class="ibox-tools">
                            <a href="{{ route('add-advance-salary-request') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                        </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <div class="ibox-tools col-sm-6">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-info pull-left changeStatus" value="approve" type="button">Approved </button> &nbsp;&nbsp;
                                <button class="btn btn-danger pull-left changeStatus" value="reject" type="button"> Deny </button>
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
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Record</h3>
                            <b>Are You sure want to approve advance salary request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesapprove m-l" type="button"><strong><i class="fa fa-trash"></i> Approve </strong></button>
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
