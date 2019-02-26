@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Order list</h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-orderLIst">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Company Name</th>
                                    <th>Date</th>
                                    <th>Subscription</th>
                                    <th>Request Type</th>
                                    <th>Payment</th>
                                    <th>Order Status</th>
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
                            <b>Are You sure want to approve order request ?</b><br/>
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
                            <b>Are You sure want to reject order request ?</b><br/>
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
