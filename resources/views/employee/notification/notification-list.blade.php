@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">  
            <div class="ibox float-e-margins">
                {{ csrf_field() }}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>View Notification List</h5>
                        <div class="ibox-tools">
                            <!-- <a href="{{ route('add-demo') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a> -->
                        </div>
                    </div>
                    <div class="ibox-content">
                        <!-- <h2>Coming Soon</h2> -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="notificationTable">
                                <thead>
                                    <tr>
                                        <th >id</th>
                                        <th>Message</th>
                                        <th>Notification Date</th>
                                        <!-- <th>Action</th> -->
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
</div>

<div class="row">
    <div class="col-lg-12">

    </div>
</div>
@endsection
