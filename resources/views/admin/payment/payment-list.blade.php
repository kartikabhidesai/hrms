@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Payment list</h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bpaymented table-hover dataTables-company" id="dataTables-paymentLIst">
                            <thead>
                                <tr>
                                <th>id</th>
                                    <th>Payment Name</th>
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
<div id="enableModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Enable Record</h3>
                            <b>Are You sure want to enable payment request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-danger pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-primary pull-right yesenable m-l" type="button"><strong><i class="fa fa-trash"></i> Enable </strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="disableModel" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Disable Record</h3>
                            <b>Are You sure want to disable payment request ?</b><br/>
                            <form role="form">
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-sm btn-danger pull-right yesdisable m-l" type="button"><strong><i class="fa fa-trash"></i> Disable </strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
